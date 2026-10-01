<?php
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
        [null,        'bi-award',            [['admin.logo.index', 'logo-table', 'client_logos']], 'logos'],
        ['about',     'bi-info-circle',      [['admin.stat.index', 'stat-table', 'stats']]],
        ['global',    'bi-geo-alt',          [['admin.location.index', 'location-table', 'locations']]],
        ['contact',   'bi-telephone',        [['admin.social.index', 'social-table', 'social_links']]],
        ['cta',       'bi-megaphone',        null],
    ];
?>

<aside class="sidebar" id="sidebar">

    
    <div class="sidebar-brand">
        <div class="brand-icon"><i class="bi bi-camera-reels-fill"></i></div>
        <span class="brand-text"><?php echo e(__('messages.brand')); ?></span>
    </div>

    <nav class="sidebar-nav">

        
        <div class="nav-label"><?php echo e(__('messages.main')); ?></div>
        <ul>
            <li class="nav-item">
                <a href="<?php echo e(route('admin.dashboard')); ?>"
                   class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                    <i class="nav-icon bi bi-speedometer2"></i>
                    <span><?php echo e(__('messages.dashboard')); ?></span>
                </a>
            </li>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('message-table')): ?>
            <li class="nav-item">
                <a href="<?php echo e(route('admin.message.index')); ?>"
                   class="nav-link <?php echo e(request()->routeIs('admin.message.*') ? 'active' : ''); ?>">
                    <i class="nav-icon bi bi-envelope"></i>
                    <span><?php echo e(__('messages.contact_messages')); ?></span>
                    <?php if($unreadMessages): ?><span class="nav-badge"><?php echo e($unreadMessages); ?></span><?php endif; ?>
                </a>
            </li>
            <?php endif; ?>
        </ul>

        
        <div class="nav-label"><?php echo e(__('messages.website_content')); ?></div>
        <ul>
            <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    [$group, $icon, $items] = $section + [null, null, null];
                    $key = $section[3] ?? $group;
                    $children = collect($items ?? [])->filter(fn ($c) => Gate::allows($c[1]))->values();
                    $settingsActive = $group && request()->is('*/admin/content/' . $group);
                    $childActive = $children->contains(fn ($c) => request()->routeIs(str_replace('.index', '.*', $c[0])));
                    $canEditSettings = $group && Gate::allows('setting-edit');
                    $title = $group ? ($groups[$group]['title'][$locale] ?? $groups[$group]['title']['en']) : null;
                ?>

                <?php if($group && $children->isEmpty()): ?>
                    <?php if($canEditSettings): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.setting.edit', $group)); ?>" class="nav-link <?php echo e($settingsActive ? 'active' : ''); ?>">
                            <i class="nav-icon bi <?php echo e($icon); ?>"></i><span><?php echo e($title); ?></span>
                        </a>
                    </li>
                    <?php endif; ?>

                <?php elseif(!$group): ?>
                    <?php if($children->isNotEmpty()): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route($children[0][0])); ?>" class="nav-link <?php echo e($childActive ? 'active' : ''); ?>">
                            <i class="nav-icon bi <?php echo e($icon); ?>"></i><span><?php echo e(__('messages.' . $children[0][2])); ?></span>
                        </a>
                    </li>
                    <?php endif; ?>

                <?php elseif($canEditSettings || $children->isNotEmpty()): ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-submenu="sub-<?php echo e($key); ?>"
                           aria-expanded="<?php echo e(($settingsActive || $childActive) ? 'true' : 'false'); ?>">
                            <i class="nav-icon bi <?php echo e($icon); ?>"></i>
                            <span><?php echo e($title); ?></span>
                            <i class="bi bi-chevron-right nav-arrow"></i>
                        </a>
                        <ul class="nav-submenu <?php echo e(($settingsActive || $childActive) ? 'show' : ''); ?>" id="sub-<?php echo e($key); ?>">
                            <?php if($canEditSettings): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.setting.edit', $group)); ?>" class="nav-link <?php echo e($settingsActive ? 'active' : ''); ?>">
                                    <span><?php echo e(__('messages.section_texts')); ?></span>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php $__currentLoopData = $children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route($child[0])); ?>" class="nav-link <?php echo e(request()->routeIs(str_replace('.index', '.*', $child[0])) ? 'active' : ''); ?>">
                                    <span><?php echo e(__('messages.' . $child[2])); ?></span>
                                </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

        
        <?php if(Gate::any(['role-table', 'employee-table'])): ?>
        <div class="nav-label"><?php echo e(__('messages.Administration')); ?></div>
        <ul>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('employee-table')): ?>
            <li class="nav-item">
                <a href="<?php echo e(route('admin.employee.index')); ?>"
                   class="nav-link <?php echo e(request()->routeIs('admin.employee.*') ? 'active' : ''); ?>">
                    <i class="nav-icon bi bi-people"></i>
                    <span><?php echo e(__('messages.Employee')); ?></span>
                </a>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-table')): ?>
            <li class="nav-item">
                <a href="<?php echo e(route('admin.role.index')); ?>"
                   class="nav-link <?php echo e(request()->routeIs('admin.role.*') ? 'active' : ''); ?>">
                    <i class="nav-icon bi bi-shield-lock"></i>
                    <span><?php echo e(__('messages.Roles')); ?></span>
                </a>
            </li>
            <?php endif; ?>
        </ul>
        <?php endif; ?>

    </nav>

    
    <div class="sidebar-footer">
        <ul>
            <li class="nav-item">
                <a href="<?php echo e(route('admin.login.edit', auth('admin')->id())); ?>"
                   class="nav-link <?php echo e(request()->routeIs('admin.login.edit') ? 'active' : ''); ?>">
                    <i class="nav-icon bi bi-gear"></i>
                    <span><?php echo e(__('messages.settings')); ?></span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"
                   onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                    <i class="nav-icon bi bi-box-arrow-right"></i>
                    <span><?php echo e(__('messages.sign_out')); ?></span>
                </a>
            </li>
        </ul>
        <button class="sidebar-collapse-btn" id="sidebarCollapseBtn" title="<?php echo e(__('messages.collapse_sidebar')); ?>">
            <i class="bi bi-arrow-bar-left"></i>
        </button>
    </div>

</aside>
<?php /**PATH C:\xampp\htdocs\mersat\resources\views/admin/includes/sidebar.blade.php ENDPATH**/ ?>