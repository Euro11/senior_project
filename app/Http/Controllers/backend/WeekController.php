<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Week;
use Session;
use DB;
class WeekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            $week = new Week;
            $week->fill($request->all());
            $week->save();
        } catch(\exception $e){
            die($e->getMessage());
        }
        Session::flash('success', 'day name was created!');
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
        $week = Week::find($id);
        return view('backend.Role&week.EditWeek', compact('week')); 
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
            $week = Week::find($id);
            $week->fill($request->all());
            $week->save();
        } catch(\exception $e){
            die($e->getMessage());
        }
        Session::flash('warning', 'Day name was update!');
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
            $week = Week::find($id);
            $week->delete();
        } catch(\exception $e){
            die($e->getMessage());
        }
        Session::flash('success', 'Day name was deleted!');
        return redirect()->route('role.index');
    }
}
