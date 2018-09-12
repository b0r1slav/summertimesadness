<?php

// evaluations
Breadcrumbs::register('evaluations', function ($breadcrumbs) {
    $breadcrumbs->push('Users', route('evaluations.index'));
});

// evaluations > evaluations show
Breadcrumbs::register('evaluations.show', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('evaluations');
    $breadcrumbs->push($user->name , route('evaluations.show', compact('user')));
});

// points-approvement
Breadcrumbs::register('points-approvement', function ($breadcrumbs) {
    $breadcrumbs->push('Points Approvement', route('points-approvement'));
});