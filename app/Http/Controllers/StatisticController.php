<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Subject;
use App\Section;
use Session;
use Auth;

class StatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::User()->id;
        $user = User::find($user_id);

        $subject = Subject::all();
        $section = Section::select('section.*', 'week.day_name')
                    ->join('week', 'section.class_day', '=', 'week.id')
                    ->join('classroom', 'section.id', '=', 'classroom.section_id')
                    ->where('classroom.student_id', '=', $user_id)                    
                    ->get();
        return view('frontend.Statistic.statistic', compact('user', 'subject', 'section'));
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
        $user = User::find(Auth::User()->id);

        $section = Section::select('section.*', 'subject.sub_name', 'week.day_name')
                    ->join('week', 'section.class_day', '=', 'week.id')
                    ->join('subject', 'section.subject_id', '=', 'subject.id')
                    ->where('section.id', '=', $id)
                    ->get();

        $static = Section::select('section.id', 'check_attendance.status_check', 'check_attendance.created_at', 'check_attendance.updated_at')
                    ->join('classroom', 'section.id', '=', 'classroom.section_id')
                    ->join('check_attendance', 'classroom.id', '=', 'check_attendance.classroom_id')
                    ->where([                            
                            ['classroom.student_id', '=', $user->id],
                            ['classroom.section_id', '=', $id]
                    ])
                    ->get();
        $score = 0;
        foreach ($static as $stat) {
            if ($stat->status_check == 1) {
                $score += 1;
            } else if ($stat->status_check == 3) {
                $score += 0.5;
            }
        }
        // dd($score);
        return view('frontend.Statistic.statisticDetail', compact('user', 'section', 'static', 'score'));
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
