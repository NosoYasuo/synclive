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

//ログインした人だけが見えるページ
Route::group(['middleware' => 'auth'], function () {


Route::post('postChannel', 'SyncController@store_channel');
Route::post('postWatch', 'SyncController@store_watch');

Route::get('userpage/{id}', 'UserController@userpage');

Route::get('mypage', 'UserController@mypage');

//chatに関して
Route::get('/chat/{id}', 'SyncController@chat');
Route::post('/add', 'SyncController@store_chat');
Route::get('chat/result/ajax', 'SyncController@getData');
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
Route::get('/home', 'HomeController@index')->name('home');
