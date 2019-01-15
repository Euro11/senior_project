<?php

namespace App\Http\Controllers\backend\subject;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subject;
use App\Section;
use Session;
use DB;

class SectionController extends Controller
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
    public function createSection($id)
    {
        $subject = Subject::find($id);
        return view('backend.ManageSubject.CreateSection', compact('subject'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        try{   
            // store in the database
            $section = new Section;
            // $section->id = $request->id;
            // $section->name = $request->name;
            // $section->year = $request->year;
            // $section->class_date = $request->class_date;
            // $section->class_day = $request->class_day;
            // $section->subject_id = $request->subject_id;
            $section->fill($request->all());
            $section->std_count = 0;
            $section->save();
            
        } catch(\exception $e){
            die($e->getMessage());
        }
        Session::flash('success', 'Section was created!');
        return redirect()->route('managesubject.show', $section->subject_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $section = Section::find($id);
        return view('backend.ManageSubject.classroom', compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $section = Section::find($id);
        return view('backend.ManageSubject.EditSection', compact('section'));
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
        $section = Section::find($id);
        $section->fill($request->all());
        $section->save();
        Session::flash('warning', 'Section was updated!');
        return redirect()->route('managesubject.show', $section->subject_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section = Section::find($id);
        $section->delete();
        Session::flash('delete', 'Section was deleted!');
        return redirect()->route('managesubject.show', $section->subject_id);
    }
}
