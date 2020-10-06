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
		/**
		 * Clear any existing cart sessions, if the user has any.
		 * Reset all preferences in the cart including the profile building
		 * questions we ask such as daily meal count, snacks etc.
		 * And then make sure the user always lands on the 3rd or 4th page
		 * in questions series - skip the trivia.
		 */
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
		$options->setMealsPerDay(request('meals_per_day', 2));
		$options->setAllergies(request('allergies', []));
		$options->setDietaryRequirement(request('dietary_requirement', DietaryRequirement::None));
		$state = new State(\auth()->user(), $options);
		$state->update();
		return redirect()->route('cart.index');
	}
}