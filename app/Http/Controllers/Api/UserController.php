<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\ApiRegisterRequest;
use App\Http\Requests\ApiResetPassRequest;
use App\Http\Requests\ApiSendResetPasswordLinkEmailRequest;
use App\Notifications\SendResetLinkEmail;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


/**
  @OA\Info(
      description="",
      version="1.0.0",
      title="RealEstate API",
 )
 */

/**
  @OA\SecurityScheme(
      securityScheme="bearerAuth",
          type="http",
          scheme="bearer",
          bearerFormat="JWT"
      ),
 */
class UserController extends Controller
{
    /**
        @OA\Post(
            path="/api/auth/login",
            tags={"Login User"},
            summary="Login",
            operationId="login",

            @OA\Parameter(
                name="email",
                in="query",
                required=true,
                @OA\Schema(
                    type="string"
                )
            ),
            @OA\Parameter(
                name="password",
                in="query",
                required=true,
                @OA\Schema(
                    type="string"
                )
            ),
            @OA\Response(
                response=200,
                description="Success",
                @OA\MediaType(
                    mediaType="application/json",
                )
            ),
            @OA\Response(
                response=401,
                description="Unauthorized"
            ),
            @OA\Response(
                response=400,
                description="Invalid request"
            ),
            @OA\Response(
                 response=404,
                description="not found"
            ),
        )
    */

    /*
        login API
        @return \Illuminate\Http\Response
    */
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

    /**
        @OA\Post(
            path="/api/auth/register",
            tags={"Register User"},
            summary="Register",
            operationId="Register",


            @OA\Parameter(
                name="name",
                in="query",
                required=true,
                @OA\Schema(
                    type="string"
                )
            ),
            @OA\Parameter(
                name="email",
                in="query",
                required=true,
                @OA\Schema(
                    type="string"
                )
            ),
            @OA\Parameter(
                name="password",
                in="query",
                required=true,
                @OA\Schema(
                    type="string"
                )
            ),
            @OA\Response(
                response=200,
                description="Success",
                @OA\MediaType(
                    mediaType="application/json",
                )
            ),
            @OA\Response(
            response=401,
            description="Unauthorized"
            ),
            @OA\Response(
            response=400,
            description="Invalid request"
            ),
            @OA\Response(
            response=404,
            description="not found"
            ),
        )
    */

    /*
      register API

      @return \Illuminate\Http\Response
    */
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


    /**
     * @OA\Get(
     *     path="/api/auth/logout",
     *     operationId="logout",
     *     summary="Logout",
     *     tags={"Logout User"},
     *     description="Logs user out(revokes token)",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *          response="200",
     *          description="success",
     *          @OA\JsonContent(),
     *     )
     * )
     *
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }


    /**
     * @OA\Post(
     *     path="/api/auth/password/email",
     *     operationId="Send Reset Password",
     *     summary="Send Reset Password",
     *     tags={"Send Reset Password"},
     *     description="Send Reset password",
     *     @OA\Parameter(
     *          name="email",
     *          in="query",
     *          required=true,
     *          description="",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Response(
     *          response="200",
     *          description="success",
     *     @OA\JsonContent(),
     *     )
     * )
     * @param ApiSendResetPasswordLinkEmailRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
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


    /**
     * @OA\Post(
     *     path="/api/auth/password/reset/{token}",
     *     operationId="Reset Password",
     *     tags={"Reset Password"},
     *     description="Reset Password with token",
     *     @OA\Parameter(
     *          name="token",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="email",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="password",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="email",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="password_confirmation",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Response(
     *          response="200",
     *          description="success",
     *     @OA\JsonContent(),
     *     )
     * )
     * @param ApiResetPassRequest $request
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
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
