<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Search;
use App\Watch;
use App\User;
// use Validator; //バリデーションを使えるようにする
// use Auth; //認証モデルを使用する

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->search;

        // // $stock = $request->input('stock');

        // $query = Watch::query();

        if (!empty($keyword)) {
            $watches=Watch::where('title', 'LIKE', "%{$keyword}%")

                ->orWhere('author', 'LIKE', "%{$keyword}%")
                ->orWhere('user_name', 'LIKE', "%{$keyword}%") ->get();

        }

        // if (!empty($stock)) {
        //     $query->where('stock', '>=', $stock);


        // $watches = $query->get();

        return view('search', compact('watches', 'keyword'));
    }
}
