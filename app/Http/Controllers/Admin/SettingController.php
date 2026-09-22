<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Support\SiteSettings;
use Illuminate\Http\Request;

/**
 * "Website Content" pages: one page per group defined in App\Support\SiteSettings.
 * Form input names: s[key] (value, or s[key][en|ar]), f[key] (uploaded file), r[key] (remove media).
 */
class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware($this->perm('setting-edit'));
    }

    public function edit(string $group)
    {
        $definition = $this->group($group);

        $values = [];
        foreach ($definition['fields'] as $key => $field) {
            $values[$key] = Setting::raw($key);
        }

        return view('admin.settings.edit', [
            'group'  => $group,
            'def'    => $definition,
            'values' => $values,
        ]);
    }

    public function update(Request $request, string $group)
    {
        $definition = $this->group($group);
        $fields = $definition['fields'];

        $request->validate($this->rules($fields), [], $this->attributeNames($fields));

        foreach ($fields as $key => $field) {
            if (in_array($field['type'], ['image', 'video'])) {
                $this->saveMedia($request, $key);
            } elseif ($field['tr']) {
                Setting::put($key, [
                    'en' => $request->input("s.$key.en"),
                    'ar' => $request->input("s.$key.ar"),
                ]);
            } else {
                Setting::put($key, $request->input("s.$key"));
            }
        }

        return redirect()->route('admin.setting.edit', $group)->with('success', __('messages.updated'));
    }

    // ------------------------------------------------------------------

    private function group(string $group): array
    {
        $groups = SiteSettings::groups();

        abort_unless(isset($groups[$group]), 404);

        return $groups[$group];
    }

    private function rules(array $fields): array
    {
        $rules = [];

        foreach ($fields as $key => $field) {
            $type = $field['type'];

            if ($type === 'image' || $type === 'video') {
                $rules["s.$key"] = 'nullable|string|max:1000';
                $rules["f.$key"] = $type === 'video'
                    ? 'nullable|file|mimetypes:video/mp4,video/webm,video/quicktime|max:51200'
                    : 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:5120';
                $rules["r.$key"] = 'nullable';
                continue;
            }

            $rule = ($field['required'] ? 'required' : 'nullable')
                . '|string|max:' . ($type === 'textarea' ? 2000 : 500)
                . ($type === 'email' ? '|email' : '');

            if ($field['tr']) {
                $rules["s.$key"] = 'required|array';
                $rules["s.$key.en"] = $rule;
                $rules["s.$key.ar"] = $rule;
            } else {
                $rules["s.$key"] = $rule;
            }
        }

        return $rules;
    }

    private function attributeNames(array $fields): array
    {
        $names = [];

        foreach ($fields as $key => $field) {
            $label = $field['label'][app()->getLocale()] ?? $field['label']['en'];

            if ($field['tr']) {
                $names["s.$key.en"] = "$label (EN)";
                $names["s.$key.ar"] = "$label (AR)";
            } else {
                $names["s.$key"] = $label;
                $names["f.$key"] = $label;
            }
        }

        return $names;
    }

    /** New upload > new link > "remove" tick > keep what is stored. */
    private function saveMedia(Request $request, string $key): void
    {
        $old = Setting::raw($key);

        if ($request->hasFile("f.$key")) {
            Setting::put($key, uploadImage(Setting::MEDIA_FOLDER, $request->file("f.$key")));
            deleteImage(Setting::MEDIA_FOLDER, $old);
        } elseif ($request->filled("s.$key")) {
            $link = $request->input("s.$key");
            if ($link !== $old) {
                Setting::put($key, $link);
                deleteImage(Setting::MEDIA_FOLDER, $old);
            }
        } elseif ($request->boolean("r.$key")) {
            Setting::put($key, null);
            deleteImage(Setting::MEDIA_FOLDER, $old);
        }
    }
}
