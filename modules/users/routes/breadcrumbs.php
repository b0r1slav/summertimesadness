<?php

// users
Breadcrumbs::register('users', function ($breadcrumbs) {
    $breadcrumbs->push('Users', route('users.index'));
});

// users > create user
Breadcrumbs::register('users.create', function ($breadcrumbs) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push('Create' , route('users.create'));
});

// users > edit user
Breadcrumbs::register('users.edit', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push($user->name , route('users.edit', $user->id));
});

// users > send email
Breadcrumbs::register('users.mail', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push('send email to: '. $user->email , route('users.mail', $user->id));
});