<?php

namespace App\Http\Controllers\backend\subject;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subject;
use App\Section;
use App\User;
use App\Classroom;
use Session;
use DB;

class ClassroomController extends Controller
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
        foreach ($request->student_id as $value) {
            $class = new Classroom;
            $class->section_id = $request->section_id;
            $class->teacher_id = $request->teacher_id;
            $class->student_id = $request->student_id;
            $class->save();
        }
        return view('backend.ManageSubject.classroom', compact('section', 'teacher', 'student'));
        
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
        $teacher = User::where('role', '=', 2)->get();
        $student = User::where('role', '=', 1)->get();
        return view('backend.ManageSubject.addUsers', compact('section', 'teacher', 'student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
