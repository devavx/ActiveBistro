<?php

namespace App\Http\Controllers;

use App\Core\Cart\Options;
use App\Core\Cart\State;
use App\Core\Enums\Common\DaysOfWeek;
use App\Core\Enums\Common\DietaryRequirement;
use App\Core\Primitives\Arrays;
use App\Http\Requests\TailorPlanRule;
use App\Models\Allergy;
use App\Models\BottomSection;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\FaqCategory;
use App\Models\HomeSetting;
use App\Models\HowItWork;
use App\Models\Item;
use App\Models\ItemType;
use App\Models\MealPlan;
use App\Models\PrivacyPolicy;
use App\Models\SliderSetting;
use App\Models\TermCondition;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
	public function index ()
	{
		$listData = SliderSetting::query()->where('active', 1)->get();
		$homeData = HomeSetting::query()->where(['active' => 1])->get();
		$promotion = Coupon::query()->where('promote', 1)->first();
		$section = BottomSection::query()->first();
		return view('frontend.index', compact(['listData', 'homeData']))->with('coupon', $promotion)->with('section', $section);
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
		$allergies = Allergy::query()->select(['id', 'name'])->where('active', true)->get()->toArray();
		$allergies = Arrays::pairsOf($allergies, 4);
		return view('frontend.options')->with('allergies', $allergies);
	}

	public function saveOptions ()
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
		$items = HowItWork::where('active', 1)->get();
		return view('frontend.howitwork')->with('items', $items);
	}

	public function getFaq ()
	{
		$categories = FaqCategory::query()->with('faqs')->where('active', true)->orderBy('title')->get();
		return view('frontend.faqs')->with('categories', $categories);
	}

	public function termCondition ()
	{
		$tnc = TermCondition::query()->first();
		return view('frontend.term_condition')->with('tnc', $tnc);
	}

	public function privacyPolicy ()
	{
		$policy = PrivacyPolicy::query()->first();
		return view('frontend.privacy_policy')->with('policy', $policy);
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
