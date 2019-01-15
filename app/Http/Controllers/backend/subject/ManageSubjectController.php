<?php

namespace App\Http\Controllers\backend\subject;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;
use App\Subject;
use App\Section;
use App\Week;
class ManageSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subject = Subject::all();
        return view('backend.ManageSubject.ManageSubject', compact('subject'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subject = Subject::all();
        return view('backend.ManageSubject.CreateManageSubject');
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
            $subject = new Subject;
            $subject->fill($request->all());  
            $subject->save();
        } catch(\exception $e){
            die($e->getMessage());
        }
        Session::flash('success', 'Subject was created!');
        return redirect()->route('managesubject.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject = Subject::find($id);
        $section = Section::where('subject_id', '=', $id)->get();
        // dd($section);
        return view('backend.ManageSubject.Section', compact('subject', 'section'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = Subject::find($id);
        return view('backend.ManageSubject.EditManageSubject', compact('subject')); 
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
            $subject = Subject::find($id);
            $subject->fill($request->all());
            $subject->save();
        } catch(\exception $e){
            die($e->getMessage());
        }
        Session::flash('warning', 'Subject was successfully save!');
        return redirect()->route('managesubject.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = Subject::find($id);
        $subject->delete();
        Session::flash('delete', 'Subject was successfully deleted.');
        return redirect()->route('managesubject.index');
    }
}
