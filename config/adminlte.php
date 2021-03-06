<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'BizPlace',

    'title_prefix' => '',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => '<b>Biz</b>Place',

    'logo_mini' => '<b>B</b>pl',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'blue',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'home',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => 'register',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => [
        'ГЛАВНОЕ МЕНЮ',
        [
            'text' => 'Как это работает',
            'url'  => '/home',
            'icon' => 'question',
        ],
        [
            'text' => 'Администратор',
            'icon'        => 'user-secret',
            'icon_color' => 'red',
            'can'  => 'admin-control',
            'submenu' => [
                [
                    'text' => 'Пользователи',
                    'icon' => 'users',
                    'url'  => '/admin/users',
                ],
                [
                    'text' => 'Уровни',
                    'icon' => 'bar-chart',
                    'url'  => '/admin/skills',
                ],
                [
                    'text' => 'Направления/спец-ии',
                    'icon' => 'sitemap',
                    'url'  => '/admin/specialities',
                ],
                [
                    'text' => 'Технологии',
                    'icon' => 'cubes',
                    'url'  => '/admin/technologies',
                ],
                [
                    'text' => 'Оповещения',
                    'icon' => 'bell',
                    'url'  => '/admin/notes',
                ],
                [
                    'text' => 'Категории оповещений',
                    'icon' => 'bookmark',
                    'url'  => '/admin/notecategories',
                ],
                [
                    'text' => 'Управление отзывами',
                    'icon' => 'comments',
                    'url'  => '/admin/comments',
                ],
                [
                    'text' => 'Настройки',
                    'icon' => 'wrench',
                    'url'  => '/admin/settings',
                ],
            ],
        ],
        [
            'text' => 'Личный кабинет',
            'icon' => 'user',
            'icon_color' => 'aqua',
            'can'  => 'user-unconfirmed',
            'submenu' => [
                [
                    'text' => 'Редактировать профиль',
                    'icon' => 'edit',
                    'url'  => "/users/editprofile",
                    'can'  => 'user-unconfirmed',
                ],
                [
                    'text' => 'Мои специалисты',
                    'icon' => 'users',
                    'url'  => '/userPersonal',
                ],
                [
                    'text' => 'Мои проекты',
                    'icon' => 'gear',
                    'url'  => '/userProjects',
                ],
                [
                    'text' => 'Добавить специалиста',
                    'icon' => 'user-plus',
                    'url'  => '/personal/add',
                    'can'  => 'user-valid',
                ],
                [
                    'text' => 'Добавить проект',
                    'icon' => 'plus-circle',
                    'url'  => '/projects/add',
                    'can'  => 'user-valid',
                ],
                [
                    'text' => 'Мои оповещения',
                    'icon' => 'bell',
                    'url'  => '/userNotes',
                ],
            ],
        ],
        'BIZPLACE',
        [
            'text' => 'Проекты',
            'url'  => '/projects',
            'icon' => 'gears',
            'can'  => 'user-unconfirmed',
        ],
        [
            'text' => 'Компании',
            'url'  => '/companies',
            'icon' => 'bookmark',
            'can'  => 'user-unconfirmed',
        ],
        [
            'text' => 'Специалисты',
            'url'  => '/personal',
            'icon' => 'users',
            'can'  => 'user-unconfirmed',
        ],
        [
            'text' => 'Отзывы',
            'url'  => '/comments',
            'icon' => 'comments',
        ],
        [
            'text' => 'Контакты',
            'url'  => '/contacts',
            'icon' => 'globe',
        ],
        [
            'text' => 'О нас',
            'url'  => '/about',
            'icon' => 'info',
        ],
        [
            'text' => 'Конфеденциальность',
            'url'  => '/confidential',
            'icon' => 'newspaper-o',
        ],
        [
            'text' => 'На страницу приветствия',
            'url'  => '/',
            'icon' => 'home',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => true,
    ],
];
