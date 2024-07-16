<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Category;
use Illuminate\Http\Request;

class RestaurantController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $keyword = $request->input('keyword');
        $category_id = $request->input('category_id');

        $sorts = [
            '並び替え' => '',
            '価格が安い順' => 'lowest_price asc',
            '価格が高い順' => 'highest_price desc',
            '評価が高い順' => 'score desc',
        ];

        $sort_query = [];
        $sorted = '';

        if ($request->input('sort_type') !== null) {
            $slices = explode(' ', $request->input('sort_type'));
            $sort_query[$slices[0]] = $slices[1];
            $sorted = $request->input('sort_type');
        }

        if ($category_id !== null) {
            $restaurants = Restaurant::withAvg('reviews', 'score')->where('name', 'like', "%{$keyword}%")->where('category_id', $category_id)->sortable($sort_query)->paginate(30);
        } else {
            $restaurants = Restaurant::withAvg('reviews', 'score')->where('name', 'like', "%{$keyword}%")->sortable($sort_query)->paginate(30);
        }

        $categories = Category::all();

        return view('restaurants.index', compact('restaurants', 'categories', 'keyword', 'category_id', 'sorts', 'sorted'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant) {
        $reservation_start_date = date('Y-m-d');

        $reservation_start_time = $restaurant->opening_time;
        $reservation_end_time = $restaurant->closing_time;
        $time_unit = 60;

        $reviews = $restaurant->reviews()->paginate(5);

        return view('restaurants.show', compact('restaurant', 'reservation_start_date', 'time_unit', 'reservation_start_time', 'reservation_end_time', 'reviews'));
    }
}
