<?php

namespace App\Http\Controllers;

use App\Core\Cart\Options;
use App\Core\Cart\State;
use App\Core\Enums\Common\DaysOfWeek;
use App\Core\Enums\Common\DietaryRequirement;
use App\Core\Primitives\Arrays;
use App\Models\Allergy;

class OrderNowController extends Controller
{
	public function __construct ()
	{

	}

	public function index ()
	{
		auth()->user()->cart()->delete();
		$allergies = Allergy::query()->select(['id', 'name'])->where('active', true)->get()->toArray();
		$allergies = Arrays::pairsOf($allergies, 4);
		return view('frontend.options')->with('allergies', $allergies);
	}

	public function store ()
	{
		$options = new Options();
		if (request('meals_at_weekends', 0) == 1) {
			$options->setMealsAtWeekends((object)[DaysOfWeek::Saturday => true, DaysOfWeek::Sunday => true]);
		} else {
			$options->setMealsAtWeekends((object)[DaysOfWeek::Saturday => false, DaysOfWeek::Sunday => false]);
		}
		$options->setWantBreakfast(request('wantBreakfast', 0));
		$options->setWantSnacks(request('snacksPerDay', 0) > 0);
		$options->setSnacksPerDay(request('snacksPerDay', 0));
		$options->setMealsPerDay(request('meals_per_day', 2));
		$options->setAllergies(request('allergies', []));
		$options->setDietaryRequirement(request('dietary_requirement', DietaryRequirement::None));
		$state = new State(\auth()->user(), $options);
		$state->update();
		return redirect()->route('cart.index');
	}
}