<?php

namespace App\Http\Controllers;

use App\Questions;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class QuestionsController extends Controller
{
    public function getAllQuestions(Request $request)
    {
        $users = Questions::select()->where('cat_id',$request->cat_id)->get();

        if(count($users)  == 0){
            $output['error'] = true;
            $output['data'] = 'No Questions Founded ';
        }else{
            $output['error'] = false;
            $output['data'] =  $users;
        }

        return response()->json($output);
    }
    public function createQuestion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required',
            'cat_id' => 'required',
            'user_name' => 'required',
        ]);
        if ($validator->fails()) {
            $output['error'] = true;
            $output['data'] = $validator->errors()->first();
            return response()->json($output);
        } else {
            $output['error'] = false;
            $user = new Questions();
            $user->question = $request->question;
            $user->user_name = $request->user_name;
            $user->cat_id = $request->cat_id;
            $user->save();
            $output['data'] = $user;
            return response()->json($output);
        }
    }

}
