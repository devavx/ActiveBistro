<?php


namespace App\Http\Controllers;


use App\Core\Cart\State;
use Illuminate\Contracts\Support\Renderable;

class CartController extends Controller
{
    public function __construct()
    {

    }

    public function index(): Renderable
    {
        $state = new State(auth()->user());
//        dd($state);
        return view('frontend.all_meal')->with('state', $state);
    }
}