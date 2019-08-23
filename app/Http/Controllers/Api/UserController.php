<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\ApiRegisterRequest;
use App\Http\Requests\ApiSendResetPasswordLinkEmailRequest;
use App\Notifications\SendResetLinkEmail;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function login(ApiLoginRequest $request)
    {
        $credentials = request(['email', 'password']);

        $user = User::where('email',$request['email'])->count();
        if ( !$user )
        {
            return response()->json([
                'message' => 'No user with this email.'
            ]);
        }


        if(!Auth::attempt($credentials))
        {
            return response()->json([
                'message' => 'Unauthorized'
            ],401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer'
        ]);
    }

    public function register ( ApiRegisterRequest $request)
    {
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $user->save();

        return response()->json([
            'message' => 'Successfully created user!'
        ],201);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function sendResetLinkEmail(ApiSendResetPasswordLinkEmailRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'We cant find a user with that e-mail address.'
            ], 404);
        }

        $reset_token = strtolower(str_random(64));

        $user['reset_password_token'] =  $reset_token;
        $user->save();

         DB::table('password_resets')->insert([
            'email' => $user->email,
            'token' => $reset_token,
            'created_at' => Carbon::now(),
        ]);

        $user->notify(new SendResetLinkEmail($user));

        return response()->json([
            'message' => 'We have sent your password reset link!',
            'token' => $reset_token
        ]);
    }

    public function reset(ApiResetPassRequest $request, $token)
    {
        $passwordReset = DB::table('password_resets')->where([
            'token' => $token,
        ])->get();

        if (!$passwordReset) {
            return response()->json([
                'message' => 'Email or password reset token provided is invalid.'
            ], 404);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'We cant find a user with that e-mail address.'
            ], 404);
        }

        $user['password'] = bcrypt($request->password);
        $user['reset_password_token'] = '';
        $user->save();

        DB::table('password_resets')->where([
            'token' => $token,
        ])->delete();

        return response()->json($user);
    }
}
