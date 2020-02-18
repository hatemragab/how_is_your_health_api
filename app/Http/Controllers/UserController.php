<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function getAllUsers()
    {
        $users = DB::table('users')->orderBy('id', 'asc')->paginate(20);
        $output['error'] = false;
        $output['data'] = $users;
        return response()->json($output);
    }

    public function createUsers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:10|min:6',
            'email' => 'required|unique:users|email:rfc,dns',
            'phone' => 'max:20',
            'password' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            $output['error'] = true;
            $output['data'] = $validator->errors()->first();
            return response()->json($output);
        } else {
            $output['error'] = false;
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = $request->password;
            $user->save();
            $output['data'] = $user;
            return response()->json($output);
        }
    }

    public function getUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',

        ]);
        if ($validator->fails()) {
            $output['error'] = true;
            $output['data'] = $validator->errors()->first();
            return response()->json($output);
        } else {
            $output['error'] = false;

            $user = User::where('id', $request->id)->first();

            $output['data'] = $user;

            return response()->json($output);
        }

    }

    public function updateUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            $output['error'] = true;
            $output['data'] = $validator->errors()->first();
            return response()->json($output);
        } else {
            $user = User::where('id', $request->id)->first();
            $user->name=$request->name;
            $user->phone=$request->phone;
            $user->password=$request->password;
            $output['error'] = false;
            $output['data'] =$user;
            return response()->json($output);
        }

    }

    public function deleteUser(Request $request)
    {
        DB::table('users')->where('id',$request->id)->delete();
        $output['error'] = false;
        $output['data'] ='user deleted';
        return response()->json($output);
    }

    public function add_update_user_img(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'img' => 'required',

        ]);
        if ($validator->fails()) {
            $output['error'] = true;
            $output['data'] = $validator->errors()->first();
            return response()->json($output);
        } else {
            $user = User::where('email', $request->email)->first();
            $Iamge_name = time() . "." . $request->img->getClientOriginalExtension();
            $user->img = $Iamge_name;
            $user->save();
            $request->img->move(Public_path('images/users_profile_img'), $Iamge_name);
            $output['error'] = false;
            $output['data'] = $user->img;
            return response()->json($output);
        }
    }

    public function UserLogin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {

            $output['error'] = true;
            $output['data'] = $validator->errors()->first();
            return response()->json($output);
        } else {
            $user = User::where('email', $request->email)->first();

            if (isset($user)) {
                if ($user->password == $request->password) {
                    $output['error'] = false;
                    $output['data'] = $user;
                    return response()->json($output);
                } else {
                    $output['error'] = true;
                    $output['data'] = 'no user founded please register';
                    return response()->json($output);
                }

            } else {
                $output['error'] = true;
                $output['data'] = 'no user founded please register';
                return response()->json($output);
            }

        }

    }
}
