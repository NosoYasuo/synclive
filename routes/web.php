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
use App\Comment;

use Illuminate\Http\Request;

/**
 * 本のダッシュボード表示(books.blade.php)
 */
Route::get('/', function () {

    $channels = Channel::orderBy('created_at', 'asc')->get();
    $watches = Watch::orderBy('created_at', 'asc')->get();
    // dd($watches);
    return view('index', ['channels' => $channels, 'watches' => $watches]);
});

/**
 * chat表示(chat.blade.php)
 */
Route::get('/chat', function () {
    $comments = Comment::get();
    return view('chat', ['comments' => $comments]);
});



Route::post('/add', function (Request $request) {

    $user = Auth::user();
    $comment = $request->input('comment');
    Comment::create([
        'login_id' => $user->id,
        'name' => $user->name,
        'comment' => $comment
    ]);
    return redirect('chat');
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

Route::post('watch', function (Request $request) {
    //バリデーション
    $validator = Validator::make($request->all(), [
        'watch_id' => 'required|max:255',
    ]);

    //バリデーション:エラー
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    // Eloquentモデル
    $watches = new Watch;
    $watches->watch = $request->watch_id;
    $watches->users_id = "1";
    $watches->save();
    return redirect('/');
});

/**
 * 本を削除
 */
Route::delete('/channel/{channel}', function (Channel $channel) {
    $channel->delete();       //追加
    return redirect('/');  //追加
});

Route::delete('/watch/{watch}', function (Watch $watch) {
    $watch->delete();       //追加
    return redirect('/');  //追加
});

// /**
//  * 本を削除
//  */
// Route::delete('/book/{book}', function (Book $book) {
//     $book->delete();       //追加
//     return redirect('/');  //追加
// });

Route::get('top', function () {

    return 'OKです!';
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
