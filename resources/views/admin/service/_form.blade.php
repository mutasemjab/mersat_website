@push('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
<style>
.ql-container { font-family: inherit; font-size: 14px; min-height: 220px; }
.ql-toolbar { border-radius: 6px 6px 0 0 !important; }
.ql-container { border-radius: 0 0 6px 6px !important; }
.ql-editor { min-height: 200px; }
[dir="rtl"] .ql-editor { direction: rtl; text-align: right; }
</style>
@endpush

<x-admin.tr-input name="title" :label="__('messages.field.title')" :values="$item->getTranslations('title')" />
<x-admin.tr-input name="description" type="textarea" :label="__('messages.field.description')" :values="$item->getTranslations('description')" />

{{-- Rich-text content (article body) --}}
<div class="mb-3">
    <label class="form-label fw-semibold">محتوى صفحة الخدمة <small class="text-muted fw-normal">(اختياري)</small></label>
    <div class="row g-3">
        @foreach(['ar' => 'العربية', 'en' => 'English'] as $code => $langName)
        @php $contentVal = $item->exists ? ($item->getTranslation('content', $code, false) ?? '') : ''; @endphp
        <div class="col-md-6">
            <div class="lang-field" style="display:block;padding:0">
                <span class="lang-badge" title="{{ $langName }}" style="border-radius:6px 0 0 0">{{ strtoupper($code) }}</span>
                <div id="quill-{{ $code }}" dir="{{ $code === 'ar' ? 'rtl' : 'ltr' }}"></div>
                <textarea name="content[{{ $code }}]" class="d-none" id="quill-textarea-{{ $code }}">{{ old('content.' . $code, $contentVal) }}</textarea>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label">{{ __('messages.field.icon') }} <span class="text-danger">*</span></label>
        <select name="icon" class="form-select no-select2 @error('icon') is-invalid @enderror" required>
            @foreach (\App\Models\Service::ICONS as $icon)
                <option value="{{ $icon }}" @selected(old('icon', $item->icon) === $icon)>{{ __('messages.icon.' . $icon) }}</option>
            @endforeach
        </select>
        @error('icon')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-8">
        <x-admin.media-input :label="__('messages.service_custom_icon')" kind="image"
            file="image" link="image_link" remove="remove_image"
            :value="$item->getRawOriginal('image')" :url="$item->image_url" />
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<script>
(function () {
    var toolbar = [
        [{ header: [2, 3, 4, false] }],
        ['bold', 'italic', 'underline'],
        [{ list: 'ordered' }, { list: 'bullet' }],
        [{ align: [] }],
        ['link'],
        ['clean']
    ];

    ['ar', 'en'].forEach(function (code) {
        var editorEl  = document.getElementById('quill-' + code);
        var textarea  = document.getElementById('quill-textarea-' + code);
        if (!editorEl || !textarea) return;

        var q = new Quill(editorEl, { theme: 'snow', modules: { toolbar: toolbar } });

        if (textarea.value.trim()) {
            q.root.innerHTML = textarea.value;
        }

        editorEl.closest('form') && editorEl.closest('form').addEventListener('submit', function () {
            textarea.value = q.root.innerHTML === '<p><br></p>' ? '' : q.root.innerHTML;
        });
    });

    // Attach submit listener to the actual form
    var form = document.querySelector('form[enctype]');
    if (form) {
        form.addEventListener('submit', function () {
            ['ar', 'en'].forEach(function (code) {
                var ta = document.getElementById('quill-textarea-' + code);
                var ed = document.getElementById('quill-' + code);
                if (ta && ed) {
                    var html = ed.querySelector('.ql-editor').innerHTML;
                    ta.value = html === '<p><br></p>' ? '' : html;
                }
            });
        });
    }
})();
</script>
@endpush
