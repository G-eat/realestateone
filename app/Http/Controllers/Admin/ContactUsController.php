<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\ContactUs;
use App\Http\Controllers\Controller;
use App\Events\SendEmailOfContactUsEvent;
use App\Http\Requests\ContactUsRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ContactUsController extends Controller
{
    public function destroy ($id)
    {
        $contact = ContactUs::findOrFail($id);
        $contact->delete();
    }

    public function show ($id)
    {
        $contact = ContactUs::findorFail($id);

        return view('admin.contact_show')->with('contact',$contact);
    }

    public function contactusdatatable()
    {
        $contacts = ContactUs::select(['id','name','email','subject','created_at']);

        return Datatables::of($contacts)
            ->editColumn('action', function($contact) {
                return
                    '<a href="' . route('contact.show', $contact->id) . '" target="_blank"><i class="fa fa-eye text-success" aria-hidden="true"></i></a>
                 <a role="button" class="deleteButton" data-id="'. $contact->id .'"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>';
            })
            ->make();
    }
}
