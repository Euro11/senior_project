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
        $value = collect($request->student_id)->toArray();
        foreach ($value as $v) {
            $class = new Classroom;
            $class->section_id = $request->section_id;
            
            // must be string vvvv
            $class->student_id = $v;
            $class->created_at = now();
            $class->save();

            // ADD student count
            $std_count = Section::find($request->section_id);
            $std_count->std_count += 1;
            $std_count->save();
        }
        $section = Section::find($request->section_id);
        return redirect()->route('section.show', $section->id);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $student = User::where('role', '=', 1)->get();

        $student = User::select('users.*', 'classroom.student_id', 'classroom.section_id')
                    ->leftJoin('classroom','users.id', '=', 'classroom.student_id')
                    ->whereNull('classroom.student_id')                
                    ->where([
                            ['users.role', '=', 1],
                            ['classroom.section_id', '=', $id],
                    ])
                    ->get();


        $section = Section::find($id);

        dd($student);
        return view('backend.ManageSubject.addUsers', compact('section', 'student'));
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
        $classroom = Classroom::find($id);
        $section = Section::find($classroom->section_id);
        $classroom->delete();

        $section->std_count -= 1;
        $section->save();
        Session::flash('delete', 'User left the group.');
        return redirect()->route('section.show', $section->id);
    }
}
