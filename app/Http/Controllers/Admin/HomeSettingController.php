<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use Illuminate\Http\Request;

class HomeSettingController extends Controller
{
    public function index()
    {
        $listData = HomeSetting::all();
        return view('backend/admin/home-setting/index', compact('listData'));
    }

    public function create()
    {
        return view('backend/admin/home-setting/create');
    }

    public function store(Request $request)
    {
        $res = HomeSetting::query()->create($request->all());
        if ($res) {
            return redirect('admin/home_setting')->with('success', 'Record Added successfully!');
        } else {
            return redirect()->back('errormsg', 'Oops!! Something went wrong!');
        }
    }

    public function show(HomeSetting $homeSetting)
    {
        if (!empty($homeSetting)) {
            return view('backend/admin/home-setting/edit', compact('homeSetting'));
        }
        return redirect('admin/home_setting');
    }

    public function edit(HomeSetting $homeSetting)
    {
        if (!empty($homeSetting)) {
            return view('backend/admin/home-setting/edit', compact('homeSetting'));
        }
        return redirect('admin/home_setting');
    }

    public function update(Request $request, HomeSetting $homeSetting)
    {
        if ($homeSetting != null)
            $homeSetting->update($request->all());
        if ($homeSetting) {
            return redirect('admin/home_setting')->with('success', 'Record Updated successfully!');
        } else {
            return back()->with('errormsg', 'Whoops!! Somthig Went wrong! Try Again!');
        }
    }

    public function delete($id = '')
    {
        $result = array();
        $data = HomeSetting::find($id);
        if (!empty($data)) {
            $data->delete();
            $result['status'] = 'success';
            $result['message'] = 'Record Deleted Sucessfully !';
        } else {
            $result['status'] = 'error';
	        $result['message'] = 'Oops! Something Went Wrong!';
        }

        return json_encode($result);
    }

    public function changeStatus($id = '')
    {
        $result = array();
        $data = HomeSetting::find($id);
        if (!empty($data)) {
            if ($data->active) {
                $data->active = 0;
            } else {
                $data->active = 1;
            }
            $data->update();
            $result['status'] = 'success';
            $result['message'] = 'Status change successfully !';
        } else {
            $result['status'] = 'error';
            $result['message'] = 'Oops! Something Went Wrong!';
        }
        return json_encode($result);
    }
}
