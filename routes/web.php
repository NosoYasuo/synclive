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

/**
 * 本のダッシュボード表示(books.blade.php)
 */
Route::get('/', function () {

    $channels = Channel::orderBy('created_at', 'asc')->get();


    return view('index', ['channels' => $channels]);
});

/**
 * 新「本」を追加
 */
Route::post('post', function (Request $request) {
    //バリデーション
    $validator = Validator::make($request->all(), [
        'channel_id' => 'required|max:255',
    ]);

    //バリデーション:エラー
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    // Eloquentモデル
    $channels = new Channel;
    $channels->channel = $request->channel_id;
    $channels->users_id = "1";
    $channels->save();
    return redirect('/');
});



/**
 * 本を削除
 */
Route::delete('/book/{book}', function (Book $book) {
    $book->delete();       //追加
    return redirect('/');  //追加
});

Route::get('top', function () {

    return 'OKです!';
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
