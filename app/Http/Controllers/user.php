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

class user extends Controller
{
    public function mail(Request $request)
    {

        $email = $request->email_id;
        session(['email' => $email]);
        DB::delete("delete from usermail where email='$email'");
        $email_id=DB::table('usermail')->select('id')->where('email',$email)->value('id');
        DB::delete("delete from queresponse where email_id='$email_id'");
        $user = new usermail();
        $user->email = $request->email_id;
        $user->save();
        $question_id = $request->question_id;
        $data = DB::table('usermail')->select('email')->where('email', $email)->value('email');
        $ques = DB::table('que')->select('question')->where('question_id', $question_id)->get();
        $ansr = DB::table('ans')->select('answer')->where('question_id', $question_id)->get();
        $a = DB::select("select * from usermail where email='$email'");
        $mytime = Carbon\Carbon::now()->format('h:i:s');



        $minutes_to_add = 10;

        $time = Carbon\Carbon::now();
        $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));

        $stamp = $time->format('Y-m-d H:i');


        Session::put('time', $stamp);

        return view('quiz', ['ques' => $ques, 'ansr' => $ansr, 'question_id' => $question_id, 'email' => $email]);
    }

    public function result(Request $request)
    {
        $data=DB::select("select correct_answer from que");
        $a=[];
        foreach($data as $data)
        {
            array_push($a,$data->correct_answer);
        }
        $email = $request->session()->get('email');
        $email_id=DB::table('usermail')->select('id')->where('email',$email)->value('id');
        $res=DB::select("
        select ans.option_id from ans inner join queresponse on ans.answer_id=queresponse.answer_id where email_id='$email_id'
        ");
        $score=0;
        $f=DB::select("select ans.option_id from ans inner join queresponse on ans.answer_id=queresponse.answer_id  inner join que on que.question_id=ans.question_id where queresponse.email_id='$email_id' and que.correct_answer=ans.option_id");
        foreach($f as $f)
        {
            $score=$score+1;
        }


        return view('result',['score'=>$score]);

    }
}
