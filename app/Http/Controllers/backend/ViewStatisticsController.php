<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
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
    //=========================== Report Function ===========================
    public function edit($id)
    {
        // dd($id);
        $user = User::find($id);
        // Line Notify
        $token = "UROrd92sVN1PICk5Em2yl0EFoVDoHat74lpa4k8njSA";
        $str = 'นักศึกษา '.$user->name.' ไม่เข้าเรียนตามกำหนด มีความเสี่ยงที่จะไม่มีสิทธิ์ในการสอบ ';
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
        Session::flash('warning', 'คุณได้ report นักศึกษาเรียบร้อยแล้ว!');
        return back();
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
