<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faq;
use App\HowItWork;
use App\PrivacyPolicy;
use App\TermCondition;
use App\Item;
use App\Category;
use App\ItemType;
use App\MealPlan;

class FrontendController extends Controller
{
    public function index()
    {
    	return view('frontend.index');
    }

    public function login()
    {
    	return view('frontend.login');
    }

    public function signup()
    {
    	return view('frontend.process1');
    }

    public function ourmenu()
    {
        return view('frontend.our-menu');
    }
    public function about()
    {
        return view('frontend.aboutus');
    }
    public function contact()
    {
        return view('frontend.contactus');
    }

    public function howItWork()
    {
        $listData = HowItWork::where('active',1)->get();
        return view('frontend.howitwork',compact('listData'));
    }

    public function getFaq()
    {
        $listData = Faq::where('active',1)->get();
        return view('frontend.faqs',compact('listData'));
    }

    public function termCondition()
    {
        $listData = TermCondition::where('active',1)->get();
        return view('frontend.term_condition',compact('listData'));
    }

    public function privacyPolicy()
    {
        $listData = PrivacyPolicy::where('active',1)->get();
        return view('frontend.privacy_policy',compact('listData'));
    }
    public function getAllItem()
    {
        $query = Item::where('active',1);
        if (!empty(request('type'))) {
            $query->where('item_type_id',request('type'));
        }
        $listData = $query->get();

        $categoryData = Category::where('active',1)->get();
        $itemTypeData = ItemType::where('active',1)->get();
        return view('frontend.all_item',compact(['listData','categoryData','itemTypeData']));
    }
    public function getAllMeal()
    {
        $query = MealPlan::with(['items:items.id as itemId,name,selling_price'])
                        ->where('active',1);
        if (!empty(request('type'))) {
            $query->where('item_type_id',request('type'));
        }
        $listData = $query->get();

        $categoryData = Category::where('active',1)->get();
        $itemTypeData = ItemType::where('active',1)->get();
    	return view('frontend.all_meal',compact(['listData','categoryData','itemTypeData']));
    }
}
