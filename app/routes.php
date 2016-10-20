<?php

// Home page
$app->get('/', "Miniplayer\Controller\HomeController::indexAction")->bind('home');

// Login form
$app->get('/login', "Miniplayer\Controller\HomeController::loginAction")->bind('login');

// Admin zone
$app->get('/admin', "Miniplayer\Controller\AdminController::indexAction")->bind('admin');

// Submit a link
$app->match('/playlist/submit', "Miniplayer\Controller\HomeController::addPlaylistAction")->bind('submit_playlist');

// Edit an existing link
$app->match('/admin/playlist/{id}/edit', "Miniplayer\Controller\AdminController::editPlaylistAction")->bind('admin_playlist_edit');

// Remove a link
$app->get('/admin/playlist/{id}/delete', "Miniplayer\Controller\AdminController::deletePlaylistAction")->bind('admin_playlist_delete');

// Add a user
$app->match('/admin/user/add', "Miniplayer\Controller\AdminController::addUserAction")->bind('admin_user_add');

// Edit an existing user
$app->match('/admin/user/{id}/edit', "Miniplayer\Controller\AdminController::editUserAction")->bind('admin_user_edit');

// Remove a user
$app->get('/admin/user/{id}/delete', "Miniplayer\Controller\AdminController::deleteUserAction")->bind('admin_user_delete');

// Play an album or a playlist
$app->match('/play/{id}', "Miniplayer\Controller\HomeController::playAction")->bind('play_media');
