<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Coupon\StoreRequest;
use App\Models\Coupon;
use Illuminate\Contracts\Support\Renderable;

class CouponController extends Controller
{
	public function __construct ()
	{

	}

	public function index (): Renderable
	{
		$couponCollection = Coupon::query()->latest()->get();
		return view('backend.admin.coupon.index')->with('coupons', $couponCollection);
	}

	public function create (): Renderable
	{
		return view('backend.admin.coupon.create');
	}

	public function store (StoreRequest $request)
	{
		$coupon = Coupon::query()->create($request->convert());
		if ($request->wantsPromotion()) {
			Coupon::query()->where('id', '!=', $coupon->getKey())->update([
				'promote' => false
			]);
		}
		return redirect()->route('admin.coupons.index')->with('success', 'Coupon created successfully!');
	}

	public function change_promotion ($id = '')
	{
		$result = array();
		$data = Coupon::find($id);

		if (!empty($data)) {
			if ($data->promote == false) {
				$data->promote = true;
			} else {
				$data->promote = false;
			}
			$data->update();
			Coupon::query()->where('id', '!=', $data->getKey())->update([
				'promote' => false
			]);
			$result['status'] = 'success';
			$result['message'] = 'Coupon status changed successfully !';
		} else {
			$result['status'] = 'error';
			$result['message'] = 'Oops! Something went wrong!';
		}

		return json_encode($result);
	}

	public function delete ($id = '')
	{
		$result = array();
		$data = Coupon::find($id);
		if (!empty($data)) {
			$data->delete();
			$result['status'] = 'success';
			$result['message'] = 'Coupon deleted successfully !';
		} else {
			$result['status'] = 'error';
			$result['message'] = 'Oops! Something went wrong!';
		}
		return json_encode($result);
	}

	public function deleteBulk ()
	{
		$result = array();
		$result['success'] = 1;
		$result['message'] = 'Coupon(s) deleted successfully!';
		$result['data'] = [];
		Coupon::query()->whereIn('id', request('items', []))->delete();
		return response()->json($result);
	}

	public function changeStatus ($id = '')
	{
		$result = array();
		$data = Coupon::find($id);

		if (!empty($data)) {
			if ($data->active == '0') {
				$data->active = 1;
			} else {
				$data->active = 0;
			}
			$data->update();
			$result['status'] = 'success';
			$result['message'] = 'Coupon status changed successfully !';
		} else {
			$result['status'] = 'error';
			$result['message'] = 'Oops! Something went wrong!';
		}

		return json_encode($result);
	}
}