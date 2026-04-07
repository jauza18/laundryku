<?php

return [

    'title' => 'Laundry Large',
    'title_prefix' => '',
    'title_postfix' => '',

    'use_ico_only' => false,
    'use_full_favicon' => false,

    'google_fonts' => [
        'allowed' => true,
    ],

    'logo' => '<b>Laundry</b>Large',
    'logo_img' => 'vendor/adminlte/dist/img/logo laund.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Admin Logo',

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/logo laund.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    'preloader' => [
        'enabled' => true,
        'mode' => 'fullscreen',
        'img' => [
            'path' => 'vendor/adminlte/dist/img/logo laund.png',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |------------------------------------------------------------------
    | 🔥 CUSTOM SIDEBAR
    |------------------------------------------------------------------
    */
    'classes_body' => '',
    'classes_brand' => 'text-white font-weight-bold',
    'classes_brand_text' => 'font-weight-bold text-lg',

    // Sidebar aesthetic aktif
    'classes_sidebar' => 'sidebar-dark-primary elevation-4 sidebar-custom',

    'classes_sidebar_nav' => 'nav-flat nav-child-indent nav-compact',

    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |------------------------------------------------------------------
    | Sidebar
    |------------------------------------------------------------------
    */
    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_nav_accordion' => true,

    /*
    |------------------------------------------------------------------
    | MENU
    |------------------------------------------------------------------
    */
    'menu' => [

        [
            'type' => 'navbar-search',
            'text' => 'search',
            'topnav_right' => true,
        ],
        [
            'type' => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        [
            'type' => 'sidebar-menu-search',
            'text' => 'search',
        ],

        [
            'text' => 'Dashboard',
            'url' => 'dashboard',
            'icon' => 'fas fa-home text-info',
        ],

        [
            'text' => 'Laundry',
            'icon' => 'fas fa-tshirt text-pink',
            'submenu' => [

                [
                    'text' => 'Daftar Customer',
                    'url' => 'customer',
                    'icon' => 'fas fa-users text-warning',
                ],
                [
                    'text' => 'Data Member',
                    'url' => 'member',
                    'icon' => 'fas fa-id-card text-primary',
                ],
                [
                    'text' => 'Jenis Layanan',
                    'url' => 'service',
                    'icon' => 'fas fa-cogs text-success',
                ],
                [
                    'text' => 'Kelola Pesanan',
                    'url' => 'transaksi',
                    'icon' => 'fas fa-cash-register text-danger',
                ],
            ],
        ],

        [
            'text' => 'Laundry App',
            'icon' => 'fas fa-star',
            'label' => 'v1.0',
            'label_color' => 'success',
        ],
    ],

    /*
    |------------------------------------------------------------------
    | FILTER
    |------------------------------------------------------------------
    */
    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |------------------------------------------------------------------
    | 🔥 PLUGIN + CUSTOM CSS
    |------------------------------------------------------------------
    */
    'plugins' => [

        'Datatables' => ['active' => false],
        'Select2' => ['active' => false],
        'Chartjs' => ['active' => false],
        'Sweetalert2' => ['active' => false],
        'Pace' => ['active' => false],

        // 🔥 TAMBAHAN WAJIB (INI YANG BIKIN SIDEBAR JADI KEREN)
        'CustomCSS' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'css/custom.css',
                ],
            ],
        ],
    ],

    'livewire' => false,
];