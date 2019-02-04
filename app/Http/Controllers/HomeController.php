<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile($id)
    {
        $user = User::find($id);
        return view('frontend.profile.profile', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('frontend.profile.EditProfile', compact('user'));
    }

    public function update(Request $request, $id)
    {
        try{            
            $user = User::find($id);
            if (!empty($request->img_profile)) {
                $user->img_profile = $request->img_profile;
            }
            $user->fill($request->all());            
            $user->std_id = $request->std_id;
            $user->updated_at = now();
            $user->save();
        } catch(\exception $e){
            die($e->getMessage());
        }
        Session::flash('success', 'ข้อมูลส่วนตัวอัพเดทแล้ว!');
        return view('frontend.profile.profile', compact('user'));
    }
}
