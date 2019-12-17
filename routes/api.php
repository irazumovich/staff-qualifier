<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::post('users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');
    Route::apiResource('users', 'UsersApiController');

    // Crm Statuses
//    Route::apiResource('crm-statuses', 'CrmStatusApiController');

    // Crm Customers
    Route::apiResource('crm-customers', 'CrmCustomerApiController');

    // Crm Notes
    Route::apiResource('crm-notes', 'CrmNoteApiController');

    // Crm Documents
    Route::post('crm-documents/media', 'CrmDocumentApiController@storeMedia')->name('crm-documents.storeMedia');
    Route::apiResource('crm-documents', 'CrmDocumentApiController');

    // Goals
    Route::post('goals/media', 'GoalApiController@storeMedia')->name('goals.storeMedia');
    Route::apiResource('goals', 'GoalApiController');

    // Resources
    Route::apiResource('resources', 'ResourceApiController');

    // Qualifications
    Route::apiResource('qualifications', 'QualificationApiController');
});

//Auth, user
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::group([
    'middleware' => ['api-jwt','jwt.verify'],
], function ($router) {
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');
});

Route::post('users', 'UserController@store');
Route::get('users', 'UserController@index');


//Goals
Route::resource('goals', 'GoalController')->only([
    'index', 'show'
]);
Route::get('users/{user}/goals', 'UserController@goals');
Route::post('goals/result', 'GoalController@storeResultFile');

