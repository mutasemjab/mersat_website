<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

/**
 * Shared list / create / edit / delete logic for the bilingual website-content modules.
 *
 * A child controller only declares what is specific to its module (model, view, rules, media fields).
 * Views live in resources/views/admin/<module>/{_row,_form}.blade.php and are wrapped by the
 * generic admin/crud/{index,create,edit}.blade.php pages.
 */
abstract class BaseCrudController extends Controller
{
    /** @var class-string<Model> */
    protected string $model;

    /** Blade folder, e.g. "admin.service". */
    protected string $view;

    /** Route name prefix, e.g. "admin.service". */
    protected string $route;

    /** Permission prefix: <perm>-table / -add / -edit / -delete. */
    protected string $perm;

    /** Lang keys (messages.*) of the plural and singular module names. */
    protected string $plural;
    protected string $singular;

    /** Table columns shown in the list (lang keys under messages.field.*). */
    protected array $columns = [];

    /** Translatable fields => validation rule applied to both the EN and AR value. */
    protected array $translatableRules = [];

    /** Media fields: field => ['folder' => ..., 'kind' => 'image'|'video', 'required' => bool]. */
    protected array $media = [];

    /** Rules of the non-translatable, non-media fields. */
    abstract protected function rules(): array;

    public function __construct()
    {
        $this->middleware($this->perm($this->perm . '-table'))->only(['index']);
        $this->middleware($this->perm($this->perm . '-add'))->only(['create', 'store']);
        $this->middleware($this->perm($this->perm . '-edit'))->only(['edit', 'update']);
        $this->middleware($this->perm($this->perm . '-delete'))->only(['destroy']);
    }

    public function index()
    {
        $items = $this->model::query()->orderBy('sort_order')->orderBy('id')->paginate(20);

        return view('admin.crud.index', $this->meta() + ['items' => $items, 'columns' => $this->columns]);
    }

    public function create()
    {
        $item = new $this->model(['is_active' => true, 'sort_order' => (int) $this->model::max('sort_order') + 1]);

        return view('admin.crud.create', $this->meta() + ['item' => $item]);
    }

    public function store(Request $request)
    {
        $data = $this->payload($request, null);

        $item = $this->model::create($data);
        $this->afterSave($request, $item);

        return redirect()->route($this->route . '.index')->with('success', __('messages.saved'));
    }

    public function edit(int $id)
    {
        $item = $this->model::findOrFail($id);

        return view('admin.crud.edit', $this->meta() + ['item' => $item]);
    }

    public function update(Request $request, int $id)
    {
        $item = $this->model::findOrFail($id);

        $item->update($this->payload($request, $item));
        $this->afterSave($request, $item);

        return redirect()->route($this->route . '.index')->with('success', __('messages.updated'));
    }

    public function destroy(int $id)
    {
        $item = $this->model::findOrFail($id);

        foreach ($this->media as $field => $cfg) {
            deleteImage($cfg['folder'], $item->getRawOriginal($field));
        }

        $this->beforeDelete($item);
        $item->delete();

        return back()->with('success', __('messages.deleted'));
    }

    /** Rules of extra inputs a child controller saves itself in afterSave() (not stored on the model). */
    protected function extraRules(): array
    {
        return [];
    }

    /** Called once the item is created / updated, e.g. to save related records. */
    protected function afterSave(Request $request, Model $item): void
    {
    }

    /** Called right before the item is deleted, e.g. to remove related files. */
    protected function beforeDelete(Model $item): void
    {
    }

    // ------------------------------------------------------------------

    protected function meta(): array
    {
        return [
            'view'     => $this->view,
            'route'    => $this->route,
            'perm'     => $this->perm,
            'plural'   => __('messages.' . $this->plural),
            'singular' => __('messages.' . $this->singular),
        ];
    }

    /** Validate the request and turn it into attributes ready for the model. */
    private function payload(Request $request, ?Model $item): array
    {
        $request->validate($this->extraRules(), [], $this->attributeNames());
        $data = $request->validate($this->allRules($item), [], $this->attributeNames());

        foreach ($this->media as $field => $cfg) {
            unset($data[$field], $data[$field . '_link'], $data['remove_' . $field]);

            $old = $item?->getRawOriginal($field);

            if ($request->hasFile($field)) {
                $data[$field] = uploadImage($cfg['folder'], $request->file($field));
                deleteImage($cfg['folder'], $old);
            } elseif ($request->filled($field . '_link')) {
                $data[$field] = $request->input($field . '_link');
                if ($data[$field] !== $old) {
                    deleteImage($cfg['folder'], $old);
                }
            } elseif ($request->boolean('remove_' . $field)) {
                $data[$field] = null;
                deleteImage($cfg['folder'], $old);
            }
        }

        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        return $data;
    }

    private function allRules(?Model $item): array
    {
        $rules = ['is_active' => 'nullable', 'sort_order' => 'nullable|integer|min:0|max:100000'] + $this->rules();

        foreach ($this->translatableRules as $field => $rule) {
            $rules[$field] = (str_contains($rule, 'nullable') ? 'nullable' : 'required') . '|array';
            $rules[$field . '.en'] = $rule;
            $rules[$field . '.ar'] = $rule;
        }

        foreach ($this->media as $field => $cfg) {
            $needed = ($cfg['required'] ?? false) && !$item?->getRawOriginal($field);

            $file = $cfg['kind'] === 'video'
                ? 'file|mimetypes:video/mp4,video/webm,video/quicktime|max:51200'
                : 'image|mimes:jpg,jpeg,png,webp,gif|max:5120';

            $rules[$field] = ($needed ? "required_without:{$field}_link|" : 'nullable|') . $file;
            $rules[$field . '_link'] = 'nullable|string|max:1000';
            $rules['remove_' . $field] = 'nullable';
        }

        return $rules;
    }

    /** Friendly, translated field names for validation messages. */
    private function attributeNames(): array
    {
        $names = [];

        foreach (array_keys($this->allRules(null) + $this->extraRules()) as $key) {
            $base = Str::before($key, '.');
            $label = Lang::has("messages.field.$base") ? __("messages.field.$base") : $base;

            if (str_ends_with($key, '.en')) {
                $label .= ' (EN)';
            } elseif (str_ends_with($key, '.ar')) {
                $label .= ' (AR)';
            }

            $names[$key] = $label;
        }

        return $names;
    }
}
