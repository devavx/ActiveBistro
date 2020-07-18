<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Interfaces\Directories;
use App\User;
use Illuminate\Support\Facades\Hash; 


class AdminController extends Controller
{
    public function index()
    {
    	return view('backend/admin/dashboard');
    }
    public function profile()
    {
    	$userDate = Auth::user();
    	return view('backend/admin/profile', compact($userDate));
    }

    public function customerList()
    {
    	$userDate = User::all();
    	return view('backend/admin/customers', compact($userDate));
    }

    public function chnagePassword(Request $request)
    {   
        $input  = $request->all();
        $result = array(); 

        $rules = [
            'current_password' => 'required',
            'new_password'     => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $result['status']  = 'error';
            $result['message'] = $validator->errors()->first(); 
        }else {
            $user = User::find(Auth::user()->id);
            if ((Hash::check(request('current_password'), $user->password)) == false) {
                $result['status']  = 'error';
                $result['message'] = 'Check your current password';  
            }else if ((Hash::check(request('new_password'), $user->password)) == true) {
                $result['status']  = 'error';
                $result['message'] = 'Please enter a password which is not similar then current password';  
            }else {
                $user->update(['password' => Hash::make($input['new_password'])]);
                $result['status']  = 'success';
                $result['message'] = 'Password updated successfully'; 
            }
        }
        return json_encode($result);

    }

    public function updateProfile(Request $request)
    {   
        if (empty($request->user_id)) {
            $user = Auth::user();
        }else{
            $user = User::find($id);
        }
        $input = $request->all();  

        if (!empty($user)) {
            if (!empty($input['name']) && in_array($input['name'], $input)) {
                $user->name = $input['name']; 
            }if (!empty($input['address']) && in_array($input['address'], $input)) {
                $user->address = $input['address']; 
            }if (!empty($input['email']) && in_array($input['email'], $input)) {
                $user->email = $input['email']; 
            }            
            if (!empty($request->file('image'))) { 
            	//$user->profile_image = Storage::disk('secured')->putFile(Directories::Avatars, request()->file('image'));

                $allowedfileExtension=['jpg','jpeg','gif','png']; 
                $files     = $request->file('image');  
                $filename  = time().'_'.$files->getClientOriginalName(); 
                $extension = $files->getClientOriginalExtension(); 
                $name = md5($filename).'.'.$extension;  
                $files->move(public_path().'/uploads/avatars', $name);   
                $user->profile_image = $name;  
            }

            $user->update();
            $result['status']  = 'success';
            $result['message'] = 'Record has been successfully Updated!';
        }else{
            $result['status']  = 'success';
            $result['message'] = 'Something Went Wrong!';
        }
        // return back();
        return json_encode($result);       
    	 
    }

}
