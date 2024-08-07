<?php

// This file has been auto-generated by the Symfony Routing Component.

return [
    '_preview_error' => [['code', '_format'], ['_controller' => 'error_controller::preview', '_format' => 'html'], ['code' => '\\d+'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '\\d+', 'code', true], ['text', '/_error']], [], [], []],
    'app_blog_post' => [[], ['_controller' => 'App\\Controller\\BlogPostController::retrieveAllBlog'], [], [['text', '/api/blog/post']], [], [], []],
    'app_blog_topliked' => [[], ['_controller' => 'App\\Controller\\BlogPostController::topLiked'], [], [['text', '/api/blog-post/top-liked']], [], [], []],
    'app_blog_singlepost' => [['blog'], ['_controller' => 'App\\Controller\\BlogPostController::retrieveSingleBlog'], [], [['variable', '/', '[^/]++', 'blog', true], ['text', '/api/blog/post']], [], [], []],
    'app_blog_post_follows' => [[], ['_controller' => 'App\\Controller\\BlogPostController::followPosts'], [], [['text', '/api/blog-post/follows']], [], [], []],
    'app_blog_posts_add' => [[], ['_controller' => 'App\\Controller\\BlogPostController::addBlog'], [], [['text', '/api/blog-post/add']], [], [], []],
    'app_blog_post_edit' => [['blog'], ['_controller' => 'App\\Controller\\BlogPostController::editBlog'], [], [['text', '/edit'], ['variable', '/', '[^/]++', 'blog', true], ['text', '/api/blog-post']], [], [], []],
    'app_blog_post_comment' => [['blog'], ['_controller' => 'App\\Controller\\BlogPostController::addComment'], [], [['text', '/comment'], ['variable', '/', '[^/]++', 'blog', true], ['text', '/api/blog-post']], [], [], []],
    'app_blog_post_delete' => [['id'], ['_controller' => 'App\\Controller\\BlogPostController::deleteBlogPost'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/blog-post']], [], [], []],
    'app_Follow' => [['id'], ['_controller' => 'App\\Controller\\FollowersController::follow'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/Follow']], [], [], []],
    'app_unFollow' => [['id'], ['_controller' => 'App\\Controller\\FollowersController::unFollow'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/unFollow']], [], [], []],
    'app_like' => [['id'], ['_controller' => 'App\\Controller\\LikeController::like'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/like']], [], [], []],
    'app_unlike' => [['id'], ['_controller' => 'App\\Controller\\LikeController::unlike'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/unlike']], [], [], []],
    'app_profile' => [['id'], ['_controller' => 'App\\Controller\\ProfileController::show'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/profile']], [], [], []],
    'app_profile_following' => [['id'], ['_controller' => 'App\\Controller\\ProfileController::following'], [], [['text', '/following'], ['variable', '/', '[^/]++', 'id', true], ['text', '/api/profile']], [], [], []],
    'app_profile_followers' => [['id'], ['_controller' => 'App\\Controller\\ProfileController::followers'], [], [['text', '/followers'], ['variable', '/', '[^/]++', 'id', true], ['text', '/api/profile']], [], [], []],
    'app_settings_profile_image' => [[], ['_controller' => 'App\\Controller\\ProfileSettingController::profileImage'], [], [['text', '/api/settings/profile-image']], [], [], []],
    'app_settings_profile' => [[], ['_controller' => 'App\\Controller\\ProfileSettingController::profile'], [], [['text', '/api/settings-profile']], [], [], []],
    'app_get_user_profile' => [[], ['_controller' => 'App\\Controller\\ProfileSettingController::retrieveUserProfile'], [], [['text', '/api/settings-profile']], [], [], []],
    'app_update_user_profile' => [[], ['_controller' => 'App\\Controller\\ProfileSettingController::updateUserProfile'], [], [['text', '/api/setting-profile']], [], [], []],
    'api_register' => [[], ['_controller' => 'App\\Controller\\UserController::register'], [], [['text', '/api/register']], [], [], []],
    'api_confirm_email' => [[], ['_controller' => 'App\\Controller\\UserController::confirmEmail'], [], [['text', '/api/confirm-email']], [], [], []],
    'app_auth_login' => [[], ['_controller' => 'App\\Controller\\UserController::login'], [], [['text', '/api/login']], [], [], []],
    'app_forgot_password' => [[], ['_controller' => 'App\\Controller\\UserController::forgotPassword'], [], [['text', '/api/forgot-password']], [], [], []],
    'app_reset_password' => [[], ['_controller' => 'App\\Controller\\UserController::resetPassword'], [], [['text', '/api/reset-password']], [], [], []],
];
