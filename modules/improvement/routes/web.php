<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'admin', 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
    //AJAX routes
    Route::get('evaluations/data', 'ImprovementController@data');
    Route::get('evaluations/{user}/data', 'ImprovementController@dataUserEvaluations');
    Route::get('points-approvement/data', 'ImprovementController@pointsApprovementData');
    Route::get('points-approvement/count', 'ImprovementController@getPointsApprovementCount');
    Route::post('users/{user}/evaluations', 'ImprovementController@storeEvaluation')->name('users.evaluations.store');
    Route::put('evaluations/{evaluation}', 'ImprovementController@updateEvaluation')->name('evaluations.update');
    Route::put('points-approvement/{pointsApprovement}', 'ImprovementController@updatePointsApprovement')->name('points-approvement.update');
    Route::post('points-approvement/bulk-update', 'ImprovementController@updateBulkPointsApprovement')->name('points-approvement.bulk-update');
    Route::get('tasks/{user}/data', 'ImprovementController@tasksData');
    Route::post('users/{user}/tasks', 'ImprovementController@storeTask')->name('users.tasks.store');
    Route::put('tasks/{task}', 'ImprovementController@updateTask')->name('tasks.update');
    Route::delete('tasks/{task}', 'ImprovementController@deleteTask')->name('tasks.delete');
    //AJAX routes

    Route::get('evaluations', 'ImprovementController@index')->name('evaluations.index');
    Route::get('evaluations/{user}', 'ImprovementController@show')->name('evaluations.show');
    Route::get('points-approvement', 'ImprovementController@pointsApprovement')->name('points-approvement');
});

Route::group(['middleware' => 'auth'], function () {
    //AJAX routes
    Route::get('evaluations/data', 'EvaluationController@data');
    Route::get('points-approvement/data', 'PointsApprovementController@data');
    Route::post('/points-approvement/store',  'PointsApprovementController@store')->name('points-approvement.store');
    Route::delete('points-approvement/{pointsApprovement}', 'PointsApprovementController@destroy')->name('points-approvement.destroy');
    Route::get('tasks/data', 'TaskController@data');
    //AJAX routes

    Route::get('/evaluations',  'EvaluationController@index')->name('evaluations');
});