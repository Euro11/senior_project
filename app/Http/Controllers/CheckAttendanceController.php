<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Classroom;
use App\CheckAttendance;
use Session;
use DateTime;
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
                        ->select('classroom.*', 'section.subject_id', 'section.check_button_status', 'subject.sub_name', 'subject.id as sub_id', 'section.sec_lat', 'section.sec_lon', 'section.check_radius')
                        ->join('section', 'classroom.section_id', '=', 'section.id')
                        ->join('subject', 'section.subject_id', '=', 'subject.id')
                        ->where('classroom.student_id', '=', $id)
                        ->get();
        $classroom = $temp[0]; 
        $checkList = CheckAttendance::all();                     
        //Check checkattendance repeat / one day class
        foreach ($checkList as $c) {
            if ($classroom->id == $c->classroom_id) {

                $morningStart = DateTime::createFromFormat('H:i a', "8:00 am");
                $morningEnd = DateTime::createFromFormat('H:i a', "12:00 am");
                if ($c->created_at >= $morningStart && $c->created_at <= $morningEnd) {
                    Session::flash('warning', 'คุณได้เช็คชื่อแล้ว');
                    return redirect()->back();
                }

                $afternoonStart = DateTime::createFromFormat('H:i a', "1:00 pm");
                $afternoonEnd = DateTime::createFromFormat('H:i a', "5:00 pm");
                if ($c->created_at >= $afternoonStart && $c->created_at <= $afternoonEnd) {
                    Session::flash('warning', 'คุณได้เช็คชื่อแล้ว');
                    return redirect()->back();
                }

                $eveningStart = DateTime::createFromFormat('H:i a', "5:00 pm");
                $eveningEnd = DateTime::createFromFormat('H:i a', "9:00 pm");
                if ($c->created_at >= $eveningStart && $c->created_at <= $eveningEnd) {
                    Session::flash('warning', 'คุณได้เช็คชื่อแล้ว');
                    return redirect()->back();
                }
            }
        }
        
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
        // set check radius value for Km.
        $radius = $request->check_radius / 1000;

        
        
        if ($temp <= $radius) {
            try {
                $check = new CheckAttendance;
                $check->user_lat = $request->user_lat;
                $check->user_lon = $request->user_lon;
                $check->status_check = $request->status_check;
                $check->distance = $temp;
                $check->classroom_id = $id;
                $check->save();
            
                // Line Notify
                $classroom = DB::table('classroom')
                            ->select('classroom.*', 'subject.sub_name', 'users.name as teacher_name')
                            ->join('section', 'classroom.section_id', '=', 'section.id')
                            ->join('subject', 'section.subject_id', '=', 'subject.id')
                            ->join('users', 'section.teacher_id', '=', 'users.id')
                            ->where('classroom.id', '=', $id)
                            ->get();
                $classroom = $classroom[0];
                
                $user = User::find(Auth::user()->id);
                $token = "UROrd92sVN1PICk5Em2yl0EFoVDoHat74lpa4k8njSA";
                $str = $user->name.' ได้เข้าเรียนวิชา '.$classroom->sub_name."\nอาจารย์ผู้สอน : ".$classroom->teacher_name;
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://notify-api.line.me/api/notify",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => "message=".$str,
                    CURLOPT_HTTPHEADER => array(
                        "Authorization: Bearer ".$token,
                        "Cache-Control: no-cache",
                        "Content-Type: application/x-www-form-urlencoded"
                    ),
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    echo $response;
                }
                // End Line Notify
            } catch (Exception $e) {
                die($e->getMessage());
            }
            Session::flash('success', 'คุณเช็คชื่อสำเร็จ!');
            return redirect()->route('viewsubject.showMember', [$classroom->student_id, $classroom->section_id]);            
        } else {
            Session::flash('delete', 'คุณยังไม่อยู่ในห้องเรียน');    
            return redirect()->route('checkattendance.show', Auth::user()->id);            
        }        
    }
}
