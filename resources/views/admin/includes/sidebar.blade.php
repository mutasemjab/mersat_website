@php
    $u = auth('admin')->user();
    $unreadMessages = \App\Models\ContactMessage::unread()->count();
    $locale = app()->getLocale();
    $groups = \App\Support\SiteSettings::groups();

    // A content section = its texts page (settings group) + an optional list of repeatable items.
    // [icon, settings group|null, [[route, permission, label key], ...]]
    $sections = [
        ['general',   'bi-globe2',           null],
        ['hero',      'bi-film',             [['admin.slide.index', 'slide-table', 'hero_slides']]],
        [null,        'bi-chat-square-text', [['admin.ticker.index', 'ticker-table', 'ticker_items']], 'ticker'],
        ['services',  'bi-grid-3x3-gap',     [['admin.service.index', 'service-table', 'services']]],
        ['portfolio', 'bi-collection-play',  [['admin.portfolio.index', 'portfolio-table', 'portfolio_items']]],
        ['about',     'bi-info-circle',      [['admin.stat.index', 'stat-table', 'stats']]],
        ['global',    'bi-geo-alt',          [['admin.location.index', 'location-table', 'locations']]],
        ['contact',   'bi-telephone',        [['admin.social.index', 'social-table', 'social_links']]],
        ['cta',       'bi-megaphone',        null],
    ];
@endphp

<aside class="sidebar" id="sidebar">

    {{-- Brand --}}
    <div class="sidebar-brand">
        <div class="brand-icon"><i class="bi bi-camera-reels-fill"></i></div>
        <span class="brand-text">{{ __('messages.brand') }}</span>
    </div>

    <nav class="sidebar-nav">

        {{-- ── Main ─────────────────────────────────────────── --}}
        <div class="nav-label">{{ __('messages.main') }}</div>
        <ul>
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}"
                   class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-speedometer2"></i>
                    <span>{{ __('messages.dashboard') }}</span>
                </a>
            </li>
            @can('message-table')
            <li class="nav-item">
                <a href="{{ route('admin.message.index') }}"
                   class="nav-link {{ request()->routeIs('admin.message.*') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-envelope"></i>
                    <span>{{ __('messages.contact_messages') }}</span>
                    @if ($unreadMessages)<span class="nav-badge">{{ $unreadMessages }}</span>@endif
                </a>
            </li>
            @endcan
        </ul>

        {{-- ── Website Content ──────────────────────────────── --}}
        <div class="nav-label">{{ __('messages.website_content') }}</div>
        <ul>
            @foreach ($sections as $section)
                @php
                    [$group, $icon, $items] = $section + [null, null, null];
                    $key = $section[3] ?? $group;
                    $children = collect($items ?? [])->filter(fn ($c) => Gate::allows($c[1]))->values();
                    $settingsActive = $group && request()->is('*/admin/content/' . $group);
                    $childActive = $children->contains(fn ($c) => request()->routeIs(str_replace('.index', '.*', $c[0])));
                    $canEditSettings = $group && Gate::allows('setting-edit');
                    $title = $group ? ($groups[$group]['title'][$locale] ?? $groups[$group]['title']['en']) : null;
                @endphp

                @if ($group && $children->isEmpty())
                    @if ($canEditSettings)
                    <li class="nav-item">
                        <a href="{{ route('admin.setting.edit', $group) }}" class="nav-link {{ $settingsActive ? 'active' : '' }}">
                            <i class="nav-icon bi {{ $icon }}"></i><span>{{ $title }}</span>
                        </a>
                    </li>
                    @endif

                @elseif (!$group)
                    @if ($children->isNotEmpty())
                    <li class="nav-item">
                        <a href="{{ route($children[0][0]) }}" class="nav-link {{ $childActive ? 'active' : '' }}">
                            <i class="nav-icon bi {{ $icon }}"></i><span>{{ __('messages.' . $children[0][2]) }}</span>
                        </a>
                    </li>
                    @endif

                @elseif ($canEditSettings || $children->isNotEmpty())
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-submenu="sub-{{ $key }}"
                           aria-expanded="{{ ($settingsActive || $childActive) ? 'true' : 'false' }}">
                            <i class="nav-icon bi {{ $icon }}"></i>
                            <span>{{ $title }}</span>
                            <i class="bi bi-chevron-right nav-arrow"></i>
                        </a>
                        <ul class="nav-submenu {{ ($settingsActive || $childActive) ? 'show' : '' }}" id="sub-{{ $key }}">
                            @if ($canEditSettings)
                            <li class="nav-item">
                                <a href="{{ route('admin.setting.edit', $group) }}" class="nav-link {{ $settingsActive ? 'active' : '' }}">
                                    <span>{{ __('messages.section_texts') }}</span>
                                </a>
                            </li>
                            @endif
                            @foreach ($children as $child)
                            <li class="nav-item">
                                <a href="{{ route($child[0]) }}" class="nav-link {{ request()->routeIs(str_replace('.index', '.*', $child[0])) ? 'active' : '' }}">
                                    <span>{{ __('messages.' . $child[2]) }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endforeach
        </ul>

        {{-- ── Administration ───────────────────────────────── --}}
        @if (Gate::any(['role-table', 'employee-table']))
        <div class="nav-label">{{ __('messages.Administration') }}</div>
        <ul>
            @can('employee-table')
            <li class="nav-item">
                <a href="{{ route('admin.employee.index') }}"
                   class="nav-link {{ request()->routeIs('admin.employee.*') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-people"></i>
                    <span>{{ __('messages.Employee') }}</span>
                </a>
            </li>
            @endcan
            @can('role-table')
            <li class="nav-item">
                <a href="{{ route('admin.role.index') }}"
                   class="nav-link {{ request()->routeIs('admin.role.*') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-shield-lock"></i>
                    <span>{{ __('messages.Roles') }}</span>
                </a>
            </li>
            @endcan
        </ul>
        @endif

    </nav>

    {{-- Sidebar Footer --}}
    <div class="sidebar-footer">
        <ul>
            <li class="nav-item">
                <a href="{{ route('admin.login.edit', auth('admin')->id()) }}"
                   class="nav-link {{ request()->routeIs('admin.login.edit') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-gear"></i>
                    <span>{{ __('messages.settings') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"
                   onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                    <i class="nav-icon bi bi-box-arrow-right"></i>
                    <span>{{ __('messages.sign_out') }}</span>
                </a>
            </li>
        </ul>
        <button class="sidebar-collapse-btn" id="sidebarCollapseBtn" title="{{ __('messages.collapse_sidebar') }}">
            <i class="bi bi-arrow-bar-left"></i>
        </button>
    </div>

</aside>
