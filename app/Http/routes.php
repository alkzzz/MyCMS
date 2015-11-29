<?php
#BackEnd
Route::group(['as' => 'dashboard::', 'middleware' => ['role:administrator']], function () {
		Route::get('dashboard',['as'=>'home', 'uses'=>'DashboardController@index']);
		Route::get('dashboard/menu',['as'=>'menu', 'uses'=>'PageController@daftarmenu']);
		Route::post('dashboard/menu',['as'=>'urutmenu', 'uses'=>'PageController@urutmenu']);
		Route::get('dashboard/menu/tambah',['as'=>'tambahmenu', 'uses'=>'PageController@tambahmenu']);
		Route::post('dashboard/menu/tambah',['as'=>'simpanmenu', 'uses'=>'PageController@simpanmenu']);
});

#Auth
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', ['as'=>'login','uses'=>'Auth\AuthController@postLogin']);
Route::get('logout', 'Auth\AuthController@getLogout');

Route::get('dashboard/data.user', ['as'=>'datatables.user', 'uses'=>'DashboardController@postDataUser']);
Route::get('dashboard/user', ['as'=>'daftar.user' ,'uses'=>'DashboardController@daftarUser']);

#FrontEnd
Route::group(['prefix' => Localization::setLocale(), 'middleware' => ['localize'] ], function()
{
    Route::get('/', ['as'=>'homepage', 'uses'=>'HomeController@index']);
    Route::get('{menu}', ['as'=>'show.page', 'uses'=>'PageController@showPage']);
		Route::get('{kategori}/{post}', ['as'=>'show.post', 'uses'=>'PostController@showPost']);
});
