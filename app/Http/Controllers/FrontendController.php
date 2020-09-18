<?php

namespace App\Http\Controllers;

use App\Category;
use App\Core\Cart\Options;
use App\Core\Cart\State;
use App\Core\Enums\Common\DaysOfWeek;
use App\Core\Enums\Common\DietaryRequirement;
use App\Faq;
use App\HomeSetting;
use App\HowItWork;
use App\Http\Requests\TailorPlanRule;
use App\Item;
use App\ItemType;
use App\MealPlan;
use App\Models\Allergy;
use App\Models\Cart;
use App\Models\Coupon;
use App\PrivacyPolicy;
use App\SliderSetting;
use App\TermCondition;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
	public function index ()
	{
		$listData = SliderSetting::query()->where('active', 1)->get();
		$homeData = HomeSetting::query()->where(['active' => 1, 'type' => 'home_content'])->get();
		$promotion = Coupon::query()->where('promote', true)->first();
		return view('frontend.index', compact(['listData', 'homeData']))->with('coupon', $promotion);
	}

	public function login ()
	{
		return view('frontend.login');
	}

	public function signup ()
	{
		return view('frontend.sign_up');
	}

	public function tailorPlan ()
	{
		return view('frontend.tailor_plan');
	}

	public function saveTailorPlan (TailorPlanRule $request)
	{
		$userData = Auth::user();
		if (!empty($userData)) {
			$userData->weight_total = $request->weight_total;
			if ($request->get('weight_total', 'metric') == 'metric') {
				$userData->user_height = $request->user_height;
				$userData->user_weight = $request->user_weight;
				$userData->user_targert_weight = $request->user_targert_weight;
			} else {
				$userData->user_height = $this->imperialToMetricLength($request->user_height);
				$userData->user_weight = $this->imperialToMetricWeight($request->user_weight);
				$userData->user_targert_weight = $this->imperialToMetricWeight($request->user_targert_weight);
			}
			$userData->weight_goal = $request->weight_goal;
			$userData->activity_lavel = $request->activity_lavel;
			$userData->save();
			return redirect('recommended_meal');
		}
		return back();
	}

	public function recommendedMeal ()
	{
		return view('frontend.recommended_meal');
	}

	public function options ()
	{
		$allergies = Allergy::query()->select(['id', 'name'])->where('active', true)->get();
		$quadruplets = [];
		$set = [];
		$count = 0;
		$allergies->each(function (Allergy $allergy) use (&$count, &$quadruplets, &$set) {
			if ($count == 3) {
				$set[] = $allergy;
				$count++;
			} else {
				$count = 0;
				$set = [];
				$set[] = $allergy;
				$quadruplets[] = $set;
			}
		});
		return view('frontend.options')->with('allergies', $quadruplets);
	}

	public function saveOptions ()
	{
		dd(request()->all());
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

	public function ourmenu ()
	{
		$types = ItemType::query()->where('active', 1)->get();
		$meals = MealPlan::query()->with('images', 'allergies', 'items')->where('active', 1)->whereNull('day');
		$type = request('type', 'none');
		if ($type != 'none') {
			$meals->whereHas('items', function (Builder $query) use ($type) {
				$query->whereKey($type);
			});
		}
		$meals = $meals->get();
		return view('frontend.our-menu')->with('meals', $meals)->with('types', $types)->with('chosen', request('type', 'none'));
	}

	public function about ()
	{
		return view('frontend.aboutus');
	}

	public function contact ()
	{
		$data = HomeSetting::where('type', 'contact_us')->select('other_option')->first();
		$recordData = json_decode($data->other_option);
		return view('frontend.contactus', compact('recordData'));
	}

	public function howItWork ()
	{
		$listData = HowItWork::where('active', 1)->get();
		return view('frontend.howitwork', compact('listData'));
	}

	public function getFaq ()
	{
		$listData = Faq::where('active', 1)->get();
		return view('frontend.faqs', compact('listData'));
	}

	public function termCondition ()
	{
		$listData = TermCondition::where('active', 1)->get();
		return view('frontend.term_condition', compact('listData'));
	}

	public function privacyPolicy ()
	{
		$listData = PrivacyPolicy::where('active', 1)->get();
		return view('frontend.privacy_policy', compact('listData'));
	}

	public function getAllItem ()
	{
		$query = Item::where('active', 1);
		if (!empty(request('type'))) {
			$query->where('item_type_id', request('type'));
		}
		$listData = $query->get();

		$categoryData = Category::where('active', 1)->get();
		$itemTypeData = ItemType::where('active', 1)->get();
		return view('frontend.all_item', compact(['listData', 'categoryData', 'itemTypeData']));
	}

	public function getAllMeal ()
	{
		$query = MealPlan::with('items')->whereNotNull('day')->where('active', 1);
		if (!empty(request('type'))) {
			$query->where('item_type_id', request('type'));
		}
		$listData = $query->get();
		$items = [];
		foreach (DaysOfWeek::getValues() as $value) $items[$value] = [];
		$listData->transform(function (MealPlan $mealPlan) use (&$items) {
			$items[$mealPlan->day][] = (object)[
				'meal' => $mealPlan,
				'items' => $mealPlan->items,
			];
		});
		if (!auth()->user()->cart()->exists()) {
			\auth()->user()->cart()->create();
		}
		/**
		 * @var Cart $cart
		 */
		$cart = \auth()->user()->cart;
		$state = new \App\Resources\Cart\Cart($cart);
		$cart->update([
			'items' => $state
		]);
		$categoryData = Category::where('active', 1)->get();
		$itemTypeData = ItemType::where('active', 1)->get();
		return view('frontend.all_meal', compact(['listData', 'categoryData', 'itemTypeData']))->with('items', $items);
	}

	protected function imperialToMetricLength ($value)
	{
		return round($value * 30.48, 0);
	}

	protected function imperialToMetricWeight ($value)
	{
		return round($value / 2.20462, 2);
	}
}
