{{-- Media viewer for [data-lightbox] items: data-type = image | video | embed, data-src, data-caption --}}
<div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="{{ __('front.client_work') }}" hidden>
  <div class="lb-stage"></div>
  <p class="lb-caption"></p>
  <span class="lb-count"></span>
  <button type="button" class="lb-btn lb-close" aria-label="{{ __('front.close') }}"><svg viewBox="0 0 24 24"><line x1="6" y1="6" x2="18" y2="18"/><line x1="18" y1="6" x2="6" y2="18"/></svg></button>
  <button type="button" class="lb-btn lb-prev" aria-label="{{ __('front.prev_client') }}"><svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg></button>
  <button type="button" class="lb-btn lb-next" aria-label="{{ __('front.next_client') }}"><svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg></button>
</div>
