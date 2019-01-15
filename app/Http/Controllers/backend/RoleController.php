<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserRole;
use App\Week;
use Session;
use DB;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = UserRole::all();
        $week = Week::all();
        return view('backend.Role&week.Role', compact( 'role', 'week'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $role = new UserRole;
            $role->fill($request->all());
            $role->save();
        } catch(\exception $e){
            die($e->getMessage());
        }
        Session::flash('success', 'Role was created!');
        return redirect()->route('role.index');
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
        $role = UserRole::find($id);
        return view('backend.Role.EditRole', compact('role')); 
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
        try{
            $role = UserRole::find($id);
            $role->fill($request->all());
            $role->save();
        } catch(\exception $e){
            die($e->getMessage());
        }
        Session::flash('warning', 'Role was update!');
        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $role = UserRole::find($id);
            $role->delete();
        } catch(\exception $e){
            die($e->getMessage());
        }
        Session::flash('success', 'Role was deleted!');
        return redirect()->route('role.index');
    }
}
