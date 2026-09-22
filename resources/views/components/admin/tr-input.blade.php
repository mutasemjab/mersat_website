{{--
    Bilingual (EN | AR) input.
    name   : base field name            -> submitted as name[en] / name[ar]
    values : ['en' => ..., 'ar' => ...] current values
    input / dot : override the HTML name (e.g. "s[hero_kicker]") and the matching validation key ("s.hero_kicker")
--}}
@props(['name', 'label', 'values' => [], 'type' => 'text', 'required' => true, 'input' => null, 'dot' => null, 'rows' => 3])
@php
    $input = $input ?? $name;
    $dot   = $dot ?? $name;
    $values = is_array($values) ? $values : [];
@endphp
<div class="mb-3">
    <label class="form-label">
        {{ $label }} @if($required)<span class="text-danger">*</span>@endif
    </label>
    <div class="row g-2">
        @foreach (['en' => 'English', 'ar' => 'العربية'] as $code => $langName)
            <div class="col-md-6">
                <div class="lang-field">
                    <span class="lang-badge" title="{{ $langName }}">{{ strtoupper($code) }}</span>
                    @if ($type === 'textarea')
                        <textarea name="{{ $input }}[{{ $code }}]" rows="{{ $rows }}"
                                  dir="{{ $code === 'ar' ? 'rtl' : 'ltr' }}" placeholder="{{ $langName }}"
                                  class="form-control @error($dot . '.' . $code) is-invalid @enderror"
                                  @if($required) required @endif>{{ old($dot . '.' . $code, $values[$code] ?? '') }}</textarea>
                    @else
                        <input type="text" name="{{ $input }}[{{ $code }}]"
                               dir="{{ $code === 'ar' ? 'rtl' : 'ltr' }}" placeholder="{{ $langName }}"
                               value="{{ old($dot . '.' . $code, $values[$code] ?? '') }}"
                               class="form-control @error($dot . '.' . $code) is-invalid @enderror"
                               @if($required) required @endif>
                    @endif
                </div>
                @error($dot . '.' . $code)<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>
        @endforeach
    </div>
</div>
