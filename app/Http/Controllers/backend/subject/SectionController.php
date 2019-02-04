<?php

namespace App\Http\Controllers\backend\subject;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subject;
use App\Section;
use App\Classroom;
use App\User;
use Session;
use DB;
use Auth;

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
        $teacher = User::where('role', '=', 2)->get();
        return view('backend.ManageSubject.CreateSection', compact('subject', 'teacher'));
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
            // store in the database
            $section = new Section;
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
        $classroom = DB::table('classroom')
                        ->select('classroom.id', 'classroom.section_id', 'classroom.student_id', 'users.name')
                        ->join('users', 'classroom.student_id', '=', 'users.id')
                        ->Where('classroom.section_id', '=', $section->id)
                        ->get();
        return view('backend.ManageSubject.classroom', compact('section', 'classroom'));
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
        $teacher = User::where('role', '=', 2)->get();
        return view('backend.ManageSubject.EditSection', compact('section', 'teacher'));
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

    public function updateStatus(Request $request,$id){
        $section_prev = Section::find($id); //for go to previous page

        $section = Section::find($id);
        $teacherId = Auth::user()->id; //call userID in session for change check_button_status value
        if ($teacherId == $section->teacher_id) {
            if ($request->check_button_status == 1) {
                $section->check_button_status = $request->check_button_status;
                $section->save();
                Session::flash('success','เริ่มการเช็คชื่อ');
            }
            elseif ($request->check_button_status == 0) {
                $section->check_button_status = $request->check_button_status;
                $section->save();
                Session::flash('delete', 'หมดเวลาเรียน');
            }
            elseif ($request->check_button_status == 2) {
                $section->check_button_status = $request->check_button_status;
                $section->save();
                Session::flash('warning', 'หมดเวลาเช็คชื่อ');
            }
            return redirect()->route('ManageCheckAttendance.show', $section_prev->id);
        } else {
            Session::flash('delete', 'คุณไม่ใช่ผู้รับผิดชอบในรายวิชานี้');
            return redirect()->route('ManageCheckAttendance.show', $section_prev->id);
        }
    }
}
