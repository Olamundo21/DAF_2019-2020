<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/' => [[['_route' => 'app_userinterface_pages_home', '_controller' => 'App\\UserInterface\\PagesController::home'], null, null, null, false, false, null]],
        '/questions' => [[['_route' => 'app_userinterface_questions_createquestion_handle', '_controller' => 'App\\UserInterface\\Questions\\CreateQuestion::handle'], null, ['POST' => 0], null, false, false, null]],
        '/auth/access-token' => [[['_route' => 'app_userinterface_usermanagement_oauth2_authtoken_login', '_controller' => 'App\\UserInterface\\UserManagement\\OAuth2\\AuthTokenController::login'], null, null, null, false, false, null]],
        '/users/me' => [[['_route' => 'app_userinterface_usermanagement_userinfo_info', '_controller' => 'App\\UserInterface\\UserManagement\\UserInfoController::info'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [
            [['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
