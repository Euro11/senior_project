<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\UserRole;
use Session;
use DB;
use Illuminate\Support\Facades\Input as input;
use Hash;

class ManageUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')
                        ->select('users.*','role.role_name')
                        ->join('role', 'users.role', '=', 'role.id')
                        ->where('users.role', '=', 1)
                        ->orWhere('users.role', '=', 2)
                        ->get();
        return view('backend.ManageUser.ManageUser', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('backend.ManageUser.CreateManageUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $users = new User;
            $users->name = $request->name;
            $users->std_id = $request->std_id;
            $users->email = $request->email;
            $users->password = bcrypt(Input::get('password'));
            $users->role = $request->role;
            $users->save();
        } catch(\exception $e){
            die($e->getMessage());
        }
        Session::flash('success', 'User was created!');
        return redirect()->route('manageuser.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);
        return view('backend.ManageUser.EditManageUser', compact('users')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        try{          
            $users = User::find($id);
            if (!empty($request->img_profile)) {
                $users->img_profile = $request->img_profile;
            }            
            $users->name = $request->name;
            $users->email = $request->email;
            $users->std_id = $request->std_id;
            $users->role = $request->role;
            $users->updated_at = now();
            $users->save();
        } catch(\exception $e){
            die($e->getMessage());
        }
        Session::flash('warning', 'User was successfully save!');
        return redirect()->route('manageuser.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::find($id);
        if ($users->role == 3) {
            Session::flash('delete', 'User can not delete admin.');
            return redirect()->route('manageuser.index');
        } else{
            $users->delete();
            Session::flash('success', 'User was successfully deleted.');
            return redirect()->route('manageuser.index');
        }
    }

    public function changepassword($id){
        $users = User::find($id);
        return view('backend.ManageUser.change_password', compact('users'));
    }

    public function confirmpassword(Request $request, $id){
        // dd($request);
        $users = User::find($id);
        if (Hash::check(input::get('passwordold'), $users['password']) && Input::get('password') == input::get('password_confirmation')) {
            $users->password = bcrypt(Input::get('password'));
            $users->save();
            Session::flash('success', 'User Password has Changed');
            return redirect()->route('manageuser.index');
        }
        else{
            Session::flash('delete', 'User Password has not Changed!');
            return view('backend.ManageUser.change_password', compact('users'));
        }
    }
}
