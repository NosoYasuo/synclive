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

use App\Channel;
use App\Watch;
use Illuminate\Http\Request;

//ログインした人だけが見えるページ
Route::group(['middleware' => 'auth'], function () {


Route::post('postChannel', 'SyncController@store_channel');
Route::post('postWatch', 'SyncController@store_watch');

Route::get('userpage/{id}', 'UserController@userpage');

Route::get('mypage', 'UserController@mypage');

Route::post('edit_prof', 'UserController@edit_prof');
Route::get('/confirm', 'SyncController@confirm');
Route::get('/getSearch', 'SearchController@index');

//chatに関して
Route::get('/room/{id}', 'SyncController@room');
Route::post('/add', 'UserController@store_chat');
Route::get('room/result/ajax', 'UserController@getData');
});

Route::get('/', 'SyncController@index');



// 削除
Route::delete('/channel/{channel}', function (Channel $channel) {
    $channel->delete();       //追加
    return redirect('/');  //追加
});

Route::delete('/watch/{watch}', function (Watch $watch) {
    $watch->delete();       //追加
    return redirect('/');  //追加
});

Route::get('top', function () {
    return 'OKです!';
});

Auth::routes();
Route::get('/password/change', 'Auth\ChangePasswordController@edit');
Route::patch('/password/change','Auth\ChangePasswordController@update')->name('password.change');

Route::get('/home', 'HomeController@index')->name('home');
