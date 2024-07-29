<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Fundraising;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $fundraisings = Fundraising::with(['category', 'fundraiser'])
        ->where('is_active', 1)
        ->orderByDesc('id')
        ->get();

        

        return view('front.views.index', compact('categories', 'fundraisings'));
    }

    public function category(Category $category){
        return view('front.views.category', compact('category'));
    }

}
