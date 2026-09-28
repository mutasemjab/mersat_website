<div class="alert alert-info small d-flex gap-2 align-items-start">
    <i class="bi bi-info-circle mt-1"></i>
    <span>{{ __('messages.slide_hint') }}</span>
</div>

<x-admin.media-input :label="__('messages.slide_image')" kind="image" :required="true"
    file="image" link="image_link" remove="remove_image"
    :value="$item->getRawOriginal('image')" :url="$item->image_url" />

<x-admin.media-input :label="__('messages.slide_video')" kind="video"
    file="video" link="video_link" remove="remove_video"
    :value="$item->getRawOriginal('video')" :url="$item->video_url" />

<x-admin.tr-input name="kicker" :required="false" :label="__('messages.slide_kicker')" :values="$item->getTranslations('kicker')" />
<x-admin.tr-input name="title" :required="false" :label="__('messages.slide_title')" :values="$item->getTranslations('title')" />
<x-admin.tr-input name="highlight" :required="false" :label="__('messages.slide_highlight')" :values="$item->getTranslations('highlight')" />
<x-admin.tr-input name="subtitle" type="textarea" :rows="2" :required="false" :label="__('messages.slide_subtitle')" :values="$item->getTranslations('subtitle')" />
