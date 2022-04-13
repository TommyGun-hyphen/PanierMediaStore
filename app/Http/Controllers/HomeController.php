<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $top_visited_id = \DB::select('select visitable_id from shetabit_visits where visitable_id in (select visitable_id group by visitable_id order by count(visitable_id) desc) limit 5'); 
        
        $top_visited_id = array_map(function($e){
            return $e->visitable_id;
        }, $top_visited_id);
        $topVisited = Product::whereIn('id', $top_visited_id)->get();
        return view('admin.index', compact('topVisited'));
    }
}
