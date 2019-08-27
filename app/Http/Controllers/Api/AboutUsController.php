<?php

namespace App\Http\Controllers\Api;

use App\AboutUs;
use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class AboutUsController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/aboutus",
     *     operationId="Aboutus",
     *     summary="Aboutus",
     *     tags={"Aboutus"},
     *     description="Aboutus",
     *     @OA\Response(
     *          response="200",
     *          description="success",
     *          @OA\JsonContent(),
     *     )
     * )
     *
     */
    public function index()
    {
        $article = Article::inRandomOrder()->first();
        $about_us = AboutUs::first();

        return response()->json([
           'About us' => $about_us,
           'Random-Article' => $article
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/about-us",
     *     operationId="Admin Aboutus",
     *     summary="Admin Aboutus",
     *     tags={"Admin Aboutus"},
     *     description="Admin Aboutus",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *          response="200",
     *          description="success",
     *          @OA\JsonContent(),
     *     )
     * )
     *
     */
    public function aboutus()
    {
        if (Gate::allows('admin')) {
            $aboutus = AboutUs::first();
            return response()->json([
                'About-Us' => $aboutus
            ]);
        } else {
            return response()->json([
                'Message' => 'Not authorizated'
            ]);
        }
    }


    /**
     * @OA\Put(
     *     path="/api/update/about-us",
     *     operationId="Update Aboutus",
     *     summary="Admin Update Aboutus",
     *     tags={"Admin Update Aboutus"},
     *     description="Update Aboutus",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *          name="title",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="body",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Response(
     *          response="200",
     *          description="success",
     *          @OA\JsonContent(),
     *     )
     * )
     *
     */
    public function update(Request $request)
    {
        if (Gate::allows('admin')) {
            $about_us = AboutUs::first();

            if($request->input('title') == '' || $request->input('body') == '' )
            {
                return response()->json([
                   "Message" => 'Title and body are required.'
                ]);
            }

            $changes = $this->change($request->all(),$about_us);

            if($changes)
            {
                AboutUs::first()->update($changes);

                return response()->json([
                    'Message' => 'You updated about-us.'
                ]);
            }

            return response()->json([
                'Message' => 'You didnt change anything.'
            ]);
        } else {
            return response()->json([
                'Message' => 'Not authorizated'
            ]);
        }


    }
    public function change($data,$about_us)
    {
        $about_us->fill($data);
        $changes = $about_us->getDirty();
        if (count($changes) == 0) {
            return false;
        } else {
            return $changes;
        }
    }
}
