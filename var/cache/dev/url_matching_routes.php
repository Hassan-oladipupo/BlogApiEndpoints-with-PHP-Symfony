<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api/blog/post' => [[['_route' => 'app_blog_post', '_controller' => 'App\\Controller\\BlogPostController::retrieveAllBlog'], null, ['GET' => 0], null, false, false, null]],
        '/api/blog-post/top-liked' => [[['_route' => 'app_blog_topliked', '_controller' => 'App\\Controller\\BlogPostController::topLiked'], null, ['GET' => 0], null, false, false, null]],
        '/api/blog-post/follows' => [[['_route' => 'app_blog_post_follows', '_controller' => 'App\\Controller\\BlogPostController::followPosts'], null, ['GET' => 0], null, false, false, null]],
        '/api/settings-profile' => [
            [['_route' => 'app_settings_profile', '_controller' => 'App\\Controller\\ProfileSettingController::profile'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'app_get_user_profile', '_controller' => 'App\\Controller\\ProfileSettingController::retrieveUserProfile'], null, ['GET' => 0], null, false, false, null],
        ],
        '/api/setting-profile' => [[['_route' => 'app_update_user_profile', '_controller' => 'App\\Controller\\ProfileSettingController::updateUserProfile'], null, ['PUT' => 0], null, false, false, null]],
        '/api/settings/profile-image' => [[['_route' => 'app_settings_profile_image', '_controller' => 'App\\Controller\\ProfileSettingController::profileImage'], null, ['POST' => 0], null, false, false, null]],
        '/api/register' => [[['_route' => 'api_register', '_controller' => 'App\\Controller\\UserController::register'], null, ['POST' => 0], null, false, false, null]],
        '/api/confirm-email' => [[['_route' => 'api_confirm_email', '_controller' => 'App\\Controller\\UserController::confirmEmail'], null, ['POST' => 0], null, false, false, null]],
        '/api/login' => [[['_route' => 'app_auth_login', '_controller' => 'App\\Controller\\UserController::login'], null, ['POST' => 0], null, false, false, null]],
        '/api/forgot-password' => [[['_route' => 'app_forgot_password', '_controller' => 'App\\Controller\\UserController::forgotPassword'], null, ['POST' => 0], null, false, false, null]],
        '/api/reset-password' => [[['_route' => 'app_reset_password', '_controller' => 'App\\Controller\\UserController::resetPassword'], null, ['POST' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/api/(?'
                    .'|blog\\-post/(?'
                        .'|([^/]++)(*:72)'
                        .'|add(*:82)'
                        .'|([^/]++)(?'
                            .'|/(?'
                                .'|edit(*:108)'
                                .'|comment(*:123)'
                            .')'
                            .'|(*:132)'
                        .')'
                    .')'
                    .'|Follow/([^/]++)(*:157)'
                    .'|un(?'
                        .'|Follow/([^/]++)(*:185)'
                        .'|like/([^/]++)(*:206)'
                    .')'
                    .'|like/([^/]++)(*:228)'
                    .'|profile/([^/]++)(?'
                        .'|(*:255)'
                        .'|/follow(?'
                            .'|ing(*:276)'
                            .'|ers(*:287)'
                        .')'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        72 => [[['_route' => 'app_blog_post_show', '_controller' => 'App\\Controller\\BlogPostController::retrieveSingleBlog'], ['blog'], ['GET' => 0], null, false, true, null]],
        82 => [[['_route' => 'app_blog_posts_add', '_controller' => 'App\\Controller\\BlogPostController::addBlog'], [], ['POST' => 0], null, false, false, null]],
        108 => [[['_route' => 'app_blog_post_edit', '_controller' => 'App\\Controller\\BlogPostController::editBlog'], ['blog'], ['PUT' => 0], null, false, false, null]],
        123 => [[['_route' => 'app_blog_post_comment', '_controller' => 'App\\Controller\\BlogPostController::addComment'], ['blog'], ['POST' => 0], null, false, false, null]],
        132 => [[['_route' => 'app_blog_post_delete', '_controller' => 'App\\Controller\\BlogPostController::deleteBlogPost'], ['id'], ['DELETE' => 0], null, false, true, null]],
        157 => [[['_route' => 'app_Follow', '_controller' => 'App\\Controller\\FollowersController::follow'], ['id'], ['POST' => 0], null, false, true, null]],
        185 => [[['_route' => 'app_unFollow', '_controller' => 'App\\Controller\\FollowersController::unFollow'], ['id'], ['POST' => 0], null, false, true, null]],
        206 => [[['_route' => 'app_unlike', '_controller' => 'App\\Controller\\LikeController::unlike'], ['id'], ['POST' => 0], null, false, true, null]],
        228 => [[['_route' => 'app_like', '_controller' => 'App\\Controller\\LikeController::like'], ['id'], ['POST' => 0], null, false, true, null]],
        255 => [[['_route' => 'app_profile', '_controller' => 'App\\Controller\\ProfileController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        276 => [[['_route' => 'app_profile_following', '_controller' => 'App\\Controller\\ProfileController::following'], ['id'], ['GET' => 0], null, false, false, null]],
        287 => [
            [['_route' => 'app_profile_followers', '_controller' => 'App\\Controller\\ProfileController::followers'], ['id'], ['GET' => 0], null, false, false, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
