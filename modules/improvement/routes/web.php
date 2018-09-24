<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'admin', 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
    //AJAX routes
    Route::get('evaluations/data', 'EvaluationController@data');
    Route::get('evaluations/{user}/data', 'EvaluationController@dataUserEvaluations');
    Route::get('points-approvement/data', 'PointsApprovementController@data');
    Route::get('points-approvement/count', 'PointsApprovementController@getPointsApprovementCount');
    Route::post('users/{user}/evaluations', 'EvaluationController@store')->name('users.evaluations.store');
    Route::put('evaluations/{evaluation}', 'EvaluationController@updateEvaluation')->name('evaluations.update');
    Route::put('points-approvement/{pointsApprovement}', 'PointsApprovementController@updatePointsApprovement')->name('points-approvement.update');
    Route::post('points-approvement/bulk-update', 'PointsApprovementController@updateBulkPointsApprovement')->name('points-approvement.bulk-update');
    Route::get('tasks/{user}/data', 'TaskController@data');
    Route::post('users/{user}/tasks', 'TaskController@store')->name('users.tasks.store');
    Route::put('tasks/{task}', 'TaskController@update')->name('tasks.update');
    Route::delete('tasks/{task}', 'TaskController@destroy')->name('tasks.delete');
    //AJAX routes

    Route::get('evaluations', 'ImprovementController@index')->name('evaluations.index');
    Route::get('evaluations/{user}', 'ImprovementController@show')->name('evaluations.show');
    Route::get('points-approvement', 'PointsApprovementController@index')->name('points-approvement');
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