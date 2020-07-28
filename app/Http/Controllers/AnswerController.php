<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Questions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnswerController extends Controller
{
    public function getAllAnswers(Request $request)
    {
        $users = Answer::select()->where('question_id',$request->question_id)->get();

        if(count($users)  == 0){
            $output['error'] = true;
            $output['data'] = 'No Answers yest ';
        }else{
            $output['error'] = false;
            $output['data'] =  $users;
        }

        return response()->json($output);
    }
    public function createAnswer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'answer' => 'required',
            'doctor_name' => 'required',
            'question_id' => 'required',
        ]);
        if ($validator->fails()) {
            $output['error'] = true;
            $output['data'] = $validator->errors()->first();
            return response()->json($output);
        } else {
            $output['error'] = false;
            $user = new Answer();
            $user->answer = $request->answer;
            $user->doctor_name = $request->doctor_name;
            $user->question_id = $request->question_id;
            $user->save();
            $output['data'] = $user;
            return response()->json($output);
        }
    }
}
