<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Classroom;
use App\CheckAttendance;
use Session;
use Auth;
use DB;

class CheckAttendanceController extends Controller
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
        $temp = DB::table('classroom')
                        ->select('classroom.*', 'section.subject_id', 'section.check_button_status', 'subject.sub_name', 'subject.id as sub_id', 'section.sec_lat', 'section.sec_lon')
                        ->join('section', 'classroom.section_id', '=', 'section.id')
                        ->join('subject', 'section.subject_id', '=', 'subject.id')
                        ->where('classroom.student_id', '=', $id)
                        ->get();
        $classroom = $temp[0];                        
        // dd($classroom);
        return view('frontend.CheckAttendance.CheckAttendance', compact('user', 'classroom'));
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

    public function check(Request $request, $id)
    {
        //cut "กม." for save float value.
        $distance = explode(" ", $request->distance);
        $temp = $distance[0];
        // dd($temp);
        if ($temp <= 0.30) {
            try {
                $check = new CheckAttendance;
                $check->user_lat = $request->user_lat;
                $check->user_lon = $request->user_lon;
                $check->distance = $temp;
                $check->classroom_id = $id;
                $check->save();
            } catch (Exception $e) {
                die($e->getMessage());
            }
            $classroom = Classroom::find($id);
            Session::flash('success', 'คุณเช็คชื่อสำเร็จ!');
            return redirect()->route('viewsubject.showMember', [$classroom->student_id, $classroom->section_id]);            
        } else {
            Session::flash('delete', 'คุณยังไม่อยู่ในห้องเรียน');    
            return redirect()->route('checkattendance.show', Auth::user()->id);            
        }        
    }
}
