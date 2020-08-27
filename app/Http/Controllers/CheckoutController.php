<?php


namespace App\Http\Controllers;


use App\Core\Cart\State;
use App\Http\Requests\Checkout\StoreRequest;
use App\User;
use Illuminate\Contracts\Support\Renderable;

class CheckoutController extends Controller {
    protected $rules;

    public function __construct () {
        $this->rules = [
            'store' => [

            ]
        ];
    }

    public function index (): Renderable {
        $state = new State(auth()->user());
        return view('frontend.checkout')->with('state', $state);
    }

    public function store (StoreRequest $request): Renderable {
        /**
         * @var $user User
         */
        $user = auth()->user();
        if ($request->hasSeparateAddresses()) {
            $user->addresses()->createMany($request->addresses());
        } else {
            $user->addresses()->create($request->address());
        }
        return view('frontend.checkout_success');
    }
}