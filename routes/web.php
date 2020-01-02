<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('frontend.pages.home');
})->name('home');

Route::get('lang/{locale}', 'LocalizationController')->name('localization');

Route::group(['prefix' => 'pages', 'as' => 'pages.'], function() {
    Route::get('/home', function () {
        return view('frontend.pages.home');
    })->name('home');
    Route::get('/our_mission', function () {
        return view('frontend.pages.our_mission');
    })->name('our_mission');
    Route::get('/our_story', function () {
        return view('frontend.pages.our_story');
    })->name('our_story');
    Route::get('/smart_seeding_machine', function () {
        return view('frontend.pages.smart_seeding_machine');
    })->name('smart_seeding_machine');
    Route::get('/contact', function () {
        return view('frontend.pages.contact');
    })->name('contact');
    Route::get('/our_client', function () {
        return view('frontend.pages.our_client');
    })->name('our_client');
    Route::get('/job_opportunities', function () {
        return view('frontend.pages.job_opportunities');
    })->name('job_opportunities');
    Route::get('/smart_seeding_machine_page_2', function () {
        return view('frontend.pages.smart_seeding_machine_page_2');
    })->name('smart_seeding_machine_page_2');
    Route::get('/smart_seeding_machine_page_3', function () {
        return view('frontend.pages.smart_seeding_machine_page_3');
    })->name('smart_seeding_machine_page_3');
    Route::get('/smart_green_house', function () {
        return view('frontend.pages.smart_green_house');
    })->name('smart_green_house');
    Route::get('/growth_measurement_device', function () {
        return view('frontend.pages.growth_measurement_device');
    })->name('growth_measurement_device');
    Route::get('/smart_iot_platform', function () {
        return view('frontend.pages.smart_iot_platform');
    })->name('smart_iot_platform');

    Route::get('/smart_decision_support_system', function () {
        return view('frontend.pages.smart_decision_support_system');
    })->name('smart_decision_support_system');

    Route::get('/smart_farm_construction', function () {
        return view('frontend.pages.smart_farm_construction');
    })->name('smart_farm_construction');

    Route::get('/smart_farm_monitoring', function () {
        return view('frontend.pages.smart_farm_monitoring');
    })->name('smart_farm_monitoring');

    Route::get('/smart_farm_consulting', function () {
        return view('frontend.pages.smart_farm_consulting');
    })->name('smart_farm_consulting');

    Route::get('/smart_farm_operation', function () {
        return view('frontend.pages.smart_farm_operation');
    })->name('smart_farm_operation');

    Route::get('/q_and_a', function () {
        return view('frontend.pages.q_and_a');
    })->name('q_and_a');
});

Route::group(['namespace' => 'Frontend\Community', 'prefix' => 'pages', 'as' => 'pages.'], function () {
    Route::get('/public_notice', 'PublicNoticeController')->name('public_notice');
    Route::get('/smart_farm_news', 'SmartFarmNewsController')->name('smart_farm_news');
    Route::get('/detail_post/{id}', 'ShowController')->name('detail_post');
});

// Route::get('/public_notice', 'Frontend/Community/PublicNoticeController')->name('public_notice');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Backend', 'middleware' => 'auth', 'prefix' => 'cms', 'as' => 'backend.'], function() {
    Route::group(['namespace' => 'Page', 'prefix' => 'pages', 'as' => 'pages.'], function() {
        Route::get('/', 'IndexController')->name('index');
    });
    Route::group(['namespace' => 'Grapesjs', 'prefix' => 'grapesjs', 'as' => 'grapesjs.'], function() {
        Route::get('/edit/{id}', 'EditController')->name('edit');
        Route::put('/update/{id}', 'UpdateController')->name('update');
        Route::put('/restore_default/{id}', 'RestoreDefaultController')->name('restore_default');
        Route::put('/restore_previous_times/{id}', 'RestorePreviousTimesController')->name('restore_previous_times');
    });
    Route::group(['namespace' => 'Post', 'prefix' => 'posts', 'as' => 'posts.'], function() {
        Route::get('/', 'IndexController')->name('index');
        Route::get('/create', 'CreateController')->name('create');
        Route::post('/store', 'StoreController')->name('store');
        Route::get('/edit/{id}', 'EditController')->name('edit');
        Route::put('/update/{id}', 'UpdateController')->name('update');
        Route::put('/trash/{id}', 'TrashController')->name('trash');
        Route::delete('/delete/{id}', 'DeleteController')->name('delete');
        Route::group(['namespace' => 'Trash', 'prefix' => 'trashes', 'as' => 'trashes.'], function() {
            Route::get('/', 'ShowTrashController')->name('show_trash');
            Route::get('/preview/{id}', 'PreviewPostTrashedController')->name('preview_post_trashed');
            Route::put('/restore/{id}', 'RestoreController')->name('restore');
        });
    });
});