<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon;
use Session;
use DateTime;
use DateInterval;
use App\Models\usermail;
use App\Models\queresponse;

class quiz extends Controller
{
    public function quizz(Request $request, $question_id)
    {
        $email = $request->session()->get('email');
        $user = new usermail();

        $data = DB::table('usermail')->select('email')->where('email', $email)->value('email');
        $ques = DB::table('que')->select('question')->where('question_id', $question_id)->get();
        $ansr = DB::table('ans')->select('answer')->where('question_id', $question_id)->get();

        $allque=DB::table('que')->select('question_id')->get();
        if ($data == $email) {
            return view('quiz', ['ques' => $ques, 'ansr' => $ansr, 'question_id' => $question_id, 'email' => $email,'allque'=>$allque]);
        } else {
            $user->email = $request->email_id;
            $user->save();
        }
    }


    public function save(Request $request)
    {
        $email = $request->email;
        $question_id = $request->question_id;
        $result = $request->answer;
        $ques = DB::table('que')->select('question')->where('question_id', $question_id)->get();
        $ansr = DB::table('ans')->select('answer')->where('question_id', $question_id)->get();
        $ans_id = DB::table('ans')->select('answer_id')->where('answer', $result)->value('answer_id');
        $email_id = DB::table('usermail')->select('id')->where('email', $email)->value('id');
        $q_id = $question_id - 1;
        $que_id = DB::table('queresponse')->select('question_id')->where('email_id', $email_id)->where('question_id', $question_id - 1)->value('question_id');
        if ($question_id - 1 == $que_id) {
            DB::update("update queresponse set answer_id='$ans_id' where question_id='$q_id' and email_id='$email_id'");
        } else {
            $res = new queresponse();
            $res->question_id = $question_id -1;
            $res->answer_id = $ans_id;
            $res->email_id = $email_id;
            $res->save();
        }

        if($question_id==11)
        {
            return redirect()->route('test_result2');
        }
        $allque=DB::table('que')->select('question_id')->get();



        return view('quiz', ['ques' => $ques, 'ansr' => $ansr, 'question_id' => $question_id, 'email' => $email,'allque'=>$allque]);
    }
}
