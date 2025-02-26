<?php

use Illuminate\Support\Facades\Route;
use Main\User\Http\GetUser;

Route::group(['middleware' => []], static function () {
    Route::get('/v1/users/{id}', GetUser::class);
});
