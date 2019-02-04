<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Subject;
use App\Section;

class ViewSubjectCotroller extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        $user = User::find($id);
        $subject = Subject::all();
        $section = DB::table('section')->select('section.*', 'week.day_name')
                        ->join('week', 'section.class_day', '=', 'week.id')
                        ->get();
        return view('frontend.home', compact('user', 'subject', 'section'));
    }
    
    public function showMemberInGroup($id, $secId)
    {
        $user = User::find($id);
        $section = DB::table('section')->select('section.*', 'subject.sub_name', 'subject.sub_description', 'subject.sub_unit', 'week.day_name', 'users.name as teacher_name')
                        ->Join('subject', 'section.subject_id', '=', 'subject.id')
                        ->join('week', 'section.class_day', '=', 'week.id')
                        ->join('users', 'section.teacher_id', '=', 'users.id')
                        ->where('section.id', '=', $secId)
                        ->get();
        $section = $section[0];
        $usersAll = DB::table('classroom')->select('classroom.*', 'users.name', 'users.img_profile')
                        ->join('users', 'classroom.student_id', '=', 'users.id')
                        ->where('classroom.section_id', '=', $secId)
                        ->get();
        // dd($section);
        return view('frontend.Subject.SubjectDetail', compact('user', 'section', 'usersAll'));
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
