<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPassRequest;
use App\Http\Requests\SaveChangePasswordRequest;
use App\PasswordReset;
use App\User;
use Illuminate\Http\Request;
use Mail;

class ForgetPasswordController extends Controller
{
    public function showForgetPasswordForm(){
        return view('client.login-reg.reset-password');
    }

    public function postForgetPassword(ResetPassRequest $request){
        $email = $request->email;
        $token = getToken(30);

        $check_already_exist = PasswordReset::where('email',$email)->first();

        $data = [
            'email' => $email,
            'token' => $token

        ];

        if ($check_already_exist) {
            PasswordReset::where('email',$email)->update($data);
        }else{
            PasswordReset::insert($data);
        }


        Mail::send('mail/forgot_password',$data ,function ($message) use ($email) {
            $message->from('huynhthuanvugia@gmail.com', 'Miraculous');
            $message->to($email, 'Miraculous')->subject('Yêu cầu lấy lại mật khẩu tài khoản MIRACULOUS');
        });

        return view('client.login-reg.send-mail-success');
    }

    public function changePassword(Request $request){
        $check = PasswordReset::where(['email' =>  $request->email, 'token' => $request->token])->first();
        if (!$check) {
            abort(404);
        }

        return view('client.login-reg.change-password');

    }

    public function saveChangePassword(SaveChangePasswordRequest $request){
        PasswordReset::where('email',$request->email)->delete();
        User::where('email',$request->email)->update(['password' => bcrypt($request->password)]);

        return view('client.login-reg.change_password_complete');
    }
}
