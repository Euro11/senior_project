<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subject;
use App\Section;
use App\Classroom;
use App\CheckAttendance;
use Session;
use DB;
use Carbon\Carbon;

class ManageCheckAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subject = Subject::all();
        $section = DB::table('section')->select('section.*', 'week.day_name')
                        ->join('week', 'section.class_day', '=', 'week.id')
                        ->get();
        return view('backend.ManageCheckAttendance.ManageCheckAttendance', compact('subject', 'section'));        
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $section = DB::table('section')->select('section.*', 'week.day_name', 'subject.sub_name')
                        ->join('week', 'section.class_day', '=', 'week.id')
                        ->join('subject', 'section.subject_id', '=', 'subject.id')
                        ->where('section.id', '=', $id)
                        ->get();
        $section = $section[0];
        $data = DB::table('check_attendance')->select('check_attendance.*', 'classroom.student_id', 'users.name')
                    ->join('classroom', 'check_attendance.classroom_id', '=', 'classroom.id')
                    ->join('users', 'classroom.student_id', '=', 'users.id')
                    ->where('classroom.section_id', '=', $id)
                    ->whereDate('check_attendance.created_at', Carbon::today())
                    ->get();
        return view('backend.ManageCheckAttendance.CheckDetail', compact('section', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $checkattendance = CheckAttendance::find($id);

        $classroom = Classroom::find($checkattendance->classroom_id);
        
        if ($checkattendance->status_check == 0) {
            $checkattendance->status_check = 1;
            $checkattendance->updated_at = now();
            $checkattendance->save();
            Session::flash('success', 'User checked in.');
        } else if ($checkattendance->status_check == 2) {            
            $checkattendance->status_check = 3;
            $checkattendance->updated_at = now();
            $checkattendance->save();
            Session::flash('warning', 'User checked in late.');
        }        
        return redirect()->route('ManageCheckAttendance.show', $classroom->section_id);
        // Note
        // id = 0 เช็คชื่อแล้ว ยังไม่ยืนยัน
        // id = 1 เช็คชื่อแล้ว ยืนยันแล้ว
        // id = 2 เช็คชื่อแล้ว สาย ยังไม่ยืนยัน
        // id = 3 เช็คชื่อแล้ว สาย ยืนยันแล้ว
        // id = 4 ขาดเรียน
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
        $checkattendance = CheckAttendance::find($id);

        $classroom = Classroom::find($checkattendance->classroom_id);

        $checkattendance->delete();
        Session::flash('delete', 'Users do not follow the rules.');
        return redirect()->route('ManageCheckAttendance.show', $classroom->section_id);
    }
}
