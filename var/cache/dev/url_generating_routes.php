<?php

// This file has been auto-generated by the Symfony Routing Component.

return [
    'app_blog_posts_add' => [[], ['_controller' => 'App\\Controller\\BlogPostController::addBlog'], [], [['text', '/blog-post/add']], [], [], []],
    '_preview_error' => [['code', '_format'], ['_controller' => 'error_controller::preview', '_format' => 'html'], ['code' => '\\d+'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '\\d+', 'code', true], ['text', '/_error']], [], [], []],
    'app_blog_post' => [[], ['_controller' => 'App\\Controller\\BlogPostController::index'], [], [['text', '/blog/post']], [], [], []],
    'app_blog_topliked' => [[], ['_controller' => 'App\\Controller\\BlogPostController::topLiked'], [], [['text', '/blog-post/top-liked']], [], [], []],
    'app_blog_post_follows' => [[], ['_controller' => 'App\\Controller\\BlogPostController::followPosts'], [], [['text', '/blog-post/follows']], [], [], []],
    'app_blog_post_show' => [['blog'], ['_controller' => 'App\\Controller\\BlogPostController::showOne'], [], [['variable', '/', '[^/]++', 'blog', true], ['text', '/blog-post']], [], [], []],
    'app_blog_post_edit' => [['blog'], ['_controller' => 'App\\Controller\\BlogPostController::editBlog'], [], [['text', '/edit'], ['variable', '/', '[^/]++', 'blog', true], ['text', '/blog-post']], [], [], []],
    'app_blog_post_comment' => [['blog'], ['_controller' => 'App\\Controller\\BlogPostController::addComment'], [], [['text', '/comment'], ['variable', '/', '[^/]++', 'blog', true], ['text', '/blog-post']], [], [], []],
    'app_Follow' => [['id'], ['_controller' => 'App\\Controller\\FollowersController::follow'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/Follow']], [], [], []],
    'app_unFollow' => [['id'], ['_controller' => 'App\\Controller\\FollowersController::unFollow'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/unFollow']], [], [], []],
    'app_like' => [['id'], ['_controller' => 'App\\Controller\\LikeController::like'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/like']], [], [], []],
    'app_unlike' => [['id'], ['_controller' => 'App\\Controller\\LikeController::unlike'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/unlike']], [], [], []],
    'app_profile' => [['id'], ['_controller' => 'App\\Controller\\ProfileController::show'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/profile']], [], [], []],
    'app_profile_follwingr' => [['id'], ['_controller' => 'App\\Controller\\ProfileController::following'], [], [['text', '/following'], ['variable', '/', '[^/]++', 'id', true], ['text', '/profile']], [], [], []],
    'app_profile_followers' => [['id'], ['_controller' => 'App\\Controller\\ProfileController::followers'], [], [['text', '/followers'], ['variable', '/', '[^/]++', 'id', true], ['text', '/profile']], [], [], []],
    'app_settings_profile' => [[], ['_controller' => 'App\\Controller\\ProfileSettingController::profile'], [], [['text', '/settings/profile']], [], [], []],
    'app_settings_profile_image' => [[], ['_controller' => 'App\\Controller\\ProfileSettingController::profileImage'], [], [['text', '/settings/profile-image']], [], [], []],
    'api_register' => [[], ['_controller' => 'App\\Controller\\UserController::register'], [], [['text', '/api/register']], [], [], []],
    'api_confirm_email' => [[], ['_controller' => 'App\\Controller\\UserController::confirmEmail'], [], [['text', '/api/confirm-email']], [], [], []],
    'app_auth_login' => [[], ['_controller' => 'App\\Controller\\UserController::login'], [], [['text', '/api/login']], [], [], []],
    'app_forgot_password' => [[], ['_controller' => 'App\\Controller\\UserController::forgotPassword'], [], [['text', '/api/forgot-password']], [], [], []],
    'app_reset_password' => [[], ['_controller' => 'App\\Controller\\UserController::resetPassword'], [], [['text', '/api/reset-password']], [], [], []],
];