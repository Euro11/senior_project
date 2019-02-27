<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subject;
use App\Section;
use Session;
use DB;

class ViewStatisticsController extends Controller
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
        return view('backend.Statistics.Statistics', compact('subject', 'section')); 
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
        $section = DB::table('section')->select('section.*', 'subject.sub_name', 'week.day_name')
                    ->join('week', 'section.class_day', '=', 'week.id')
                    ->join('subject', 'section.subject_id', '=', 'subject.id')
                    ->where('section.id', '=', $id)
                    ->get();
        $section = $section[0];

        $users = DB::table('users')->select('users.*', 'classroom.section_id')
                ->join('classroom', 'users.id', '=', 'classroom.student_id')
                ->where('classroom.section_id', '=', $id)
                ->get();

        $static = DB::table('check_attendance')
                ->select('check_attendance.id', 'users.name', 'check_attendance.status_check', 'classroom.section_id', 'classroom.student_id', 'check_attendance.created_at')
                ->join('classroom', 'check_attendance.classroom_id', '=', 'classroom.id')
                ->join('users', 'classroom.student_id', '=', 'users.id')
                ->where('classroom.section_id', '=', $id)
                ->orderBy('check_attendance.created_at', 'asc')
                ->get();
        return view('backend.Statistics.DetailStatistics', compact('section', 'users', 'static'));
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
