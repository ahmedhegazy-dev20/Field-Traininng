<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use App\Models\Category;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        if ($request->has('category') && $request->category != '') {
            $meals = Meal::with('category')->where('category_id', $request->category)->latest()->get();
        } else {
            $meals = Meal::with('category')->latest()->get();
        }

        return view('home', compact('meals', 'categories'));
    }
}