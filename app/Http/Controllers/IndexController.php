<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use App\Category;

class IndexController extends Controller
{
    public function index(){
        $itemsAll = Item::orderBy('id','DESC')->take(3)->get();

        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        return view('index')->with(compact('itemsAll','categories'));


    }
}
