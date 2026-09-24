{{-- Built-in service icons. $icon is one of App\Models\Service::ICONS --}}
@switch($icon)
    @case('star')
        <svg class="srv-card-icon" viewBox="0 0 40 40" fill="none"><circle cx="20" cy="20" r="17" stroke="rgba(37,150,190,0.9)" stroke-width="1.5"/><path d="M20 8l1.8 9.8L32 14l-7.2 6.4 7.2 6.4-10.2-3L20 34l-1.8-10.2L8 27l7.2-6.4L8 14l10.2 3.8z" fill="rgba(37,150,190,1)"/></svg>
        @break
    @case('grid')
        <svg class="srv-card-icon" viewBox="0 0 40 40" fill="none"><rect x="6" y="6" width="11" height="11" rx="2" stroke="rgba(37,150,190,0.9)" stroke-width="1.5"/><rect x="23" y="6" width="11" height="11" rx="2" stroke="rgba(37,150,190,0.9)" stroke-width="1.5"/><rect x="6" y="23" width="11" height="11" rx="2" stroke="rgba(37,150,190,0.9)" stroke-width="1.5"/><rect x="23" y="23" width="11" height="11" rx="2" fill="rgba(37,150,190,0.2)" stroke="rgba(37,150,190,1)" stroke-width="1.5"/></svg>
        @break
    @case('chart')
        <svg class="srv-card-icon" viewBox="0 0 40 40" fill="none"><path d="M6 30l7-11 6 7 7-10 7-8" stroke="rgba(37,150,190,1)" stroke-width="1.8" stroke-linecap="round"/><circle cx="33" cy="8" r="3" fill="rgba(37,150,190,1)"/></svg>
        @break
    @case('search')
        <svg class="srv-card-icon" viewBox="0 0 40 40" fill="none"><circle cx="17" cy="17" r="10" stroke="rgba(37,150,190,0.9)" stroke-width="1.5"/><circle cx="17" cy="17" r="4" stroke="rgba(37,150,190,1)" stroke-width="1.5"/><line x1="24" y1="24" x2="35" y2="35" stroke="rgba(37,150,190,1)" stroke-width="2.5" stroke-linecap="round"/></svg>
        @break
    @case('browser')
        <svg class="srv-card-icon" viewBox="0 0 40 40" fill="none"><rect x="4" y="8" width="32" height="24" rx="3" stroke="rgba(37,150,190,0.9)" stroke-width="1.5"/><path d="M4 14h32" stroke="rgba(37,150,190,0.7)" stroke-width="1"/><circle cx="9" cy="11" r="1.5" fill="rgba(37,150,190,0.9)"/><circle cx="14" cy="11" r="1.5" fill="rgba(37,150,190,0.9)"/></svg>
        @break
    @case('growth')
        <svg class="srv-card-icon" viewBox="0 0 40 40" fill="none"><path d="M8 32 L16 20 L22 26 L28 16 L36 10" stroke="rgba(37,150,190,1)" stroke-width="1.8" stroke-linecap="round"/><circle cx="8" cy="32" r="2.5" fill="rgba(37,150,190,0.8)"/><circle cx="36" cy="10" r="2.5" fill="rgba(37,150,190,1)"/></svg>
        @break
    @case('hexagon')
        <svg class="srv-card-icon" viewBox="0 0 40 40" fill="none"><path d="M20 6 L36 14 L36 26 L20 34 L4 26 L4 14 Z" stroke="rgba(37,150,190,0.9)" stroke-width="1.5" fill="none"/><path d="M20 12 L28 16 L28 24 L20 28 L12 24 L12 16 Z" stroke="rgba(37,150,190,0.7)" stroke-width="1" fill="rgba(37,150,190,0.1)"/></svg>
        @break
    @case('package')
        <svg class="srv-card-icon" viewBox="0 0 40 40" fill="none"><rect x="5" y="10" width="26" height="20" rx="2" stroke="rgba(37,150,190,0.9)" stroke-width="1.5"/><rect x="8" y="14" width="8" height="8" rx="1" stroke="rgba(37,150,190,0.8)" stroke-width="1.2"/><line x1="19" y1="15" x2="28" y2="15" stroke="rgba(37,150,190,0.8)" stroke-width="1.2" stroke-linecap="round"/><line x1="19" y1="19" x2="28" y2="19" stroke="rgba(37,150,190,0.7)" stroke-width="1.2" stroke-linecap="round"/><line x1="8" y1="26" x2="28" y2="26" stroke="rgba(37,150,190,0.6)" stroke-width="1" stroke-linecap="round"/></svg>
        @break
    @case('print')
        <svg class="srv-card-icon" viewBox="0 0 40 40" fill="none"><rect x="5" y="8" width="30" height="24" rx="2" stroke="rgba(37,150,190,0.9)" stroke-width="1.5"/><line x1="5" y1="14" x2="35" y2="14" stroke="rgba(37,150,190,0.7)" stroke-width="1"/><line x1="5" y1="20" x2="35" y2="20" stroke="rgba(37,150,190,0.6)" stroke-width="1"/><line x1="5" y1="26" x2="35" y2="26" stroke="rgba(37,150,190,0.6)" stroke-width="1"/></svg>
        @break
    @default
        <svg class="srv-card-icon" viewBox="0 0 40 40" fill="none"><rect x="4" y="8" width="32" height="24" rx="2" stroke="rgba(37,150,190,0.9)" stroke-width="1.5"/><circle cx="20" cy="20" r="6" stroke="rgba(37,150,190,1)" stroke-width="1.5"/><circle cx="20" cy="20" r="2" fill="rgba(37,150,190,1)"/></svg>
@endswitch
