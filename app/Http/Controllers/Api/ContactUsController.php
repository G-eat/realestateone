<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\ContactUs;
use App\Events\SendEmailOfContactUsEvent;
use App\Http\Requests\ApiContactUsRequest;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class ContactUsController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/contactus",
     *     operationId="Contactus",
     *     summary="Contactus",
     *     tags={"Contactus"},
     *     description="Contactus",
     *     @OA\Parameter(
     *          name="name",
     *          in="query",
     *          required=true,
     *          description="",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="email",
     *          in="query",
     *          required=true,
     *          description="",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="subject",
     *          in="query",
     *          required=true,
     *          description="",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="content",
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
     *          @OA\JsonContent(),
     *     )
     * )
     *
     */
    public function sendmessage (ApiContactUsRequest $request)
    {
        $contact_us = new ContactUs;
        $contact_us->name = $request['name'];
        $contact_us->email = $request['email'];
        $contact_us->subject = $request['subject'];
        $contact_us->message = $request['content'];
        $contact_us->save();


        event(new SendEmailOfContactUsEvent($contact_us));

        return response()->json([
            "Message" => "message send"
        ]);
    }


    /**
     * @OA\Get(
     *     path="/api/contact-us",
     *     operationId="Admin Contactus",
     *     summary="Admin Contactus",
     *     tags={"Admin Contactus"},
     *     description="Admin Contactus",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *          response="200",
     *          description="success",
     *          @OA\JsonContent(),
     *     )
     * )
     *
     */
    public function contactus()
    {
        if (Gate::allows('admin')) {
            $contacts = ContactUs::select(['id','name','email','subject','created_at'])->get();
            return response()->json([
                'Contact-Us' => $contacts
            ]);
        } else {
            return response()->json([
                'Message' => 'Not authorizated'
            ]);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/contact/delete/{id}",
     *     operationId="Delete Contact",
     *     summary="Delete Contact",
     *     tags={"Delete Contact"},
     *     description="Delete Contact",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="",
     *          @OA\Schema(
     *              type="integer"
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
    public function destroy ($id)
    {
        if (Gate::allows('admin')) {
            $contact = ContactUs::findOrFail($id);
            $contact->delete();
            return response()->json([
                'Message' => 'You Deleted a Contact.'
            ]);
        } else {
            return response()->json([
                'Message' => 'Not authorizated'
            ]);
        }
    }

    public function show ($id)
    {
        if (Gate::allows('admin')) {
            $contact = ContactUs::findorFail($id);

            return response()->json([
                'Contact' => $contact
            ]);
        } else {
            return response()->json([
                'Message' => 'Not authorizated'
            ]);
        }
    }
}
