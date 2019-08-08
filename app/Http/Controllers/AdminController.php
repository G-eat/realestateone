<?php

namespace App\Http\Controllers;

use App\AboutUs;
use App\Article;
use App\ContactUs;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function articles ()
    {
        return view('admin.articles');
    }

    public function contactus ()
    {
        return view('admin.contactus');
    }

    public function aboutus ()
    {
        $aboutus = AboutUs::first();
        return view('admin.aboutus')->with('aboutus',$aboutus);
    }

    public function articlesdatatable()
    {
        $articles = Article::select(['id','title','city','address','type','phonenumber'])
            ->orderBy('created_at','desc');

        return Datatables::of($articles)
            ->editColumn('action', function($article) {
                return
                '<a href="' . route('article_show', $article->id) . '"><i class="fa fa-eye text-success" aria-hidden="true"></i></a>
                 <a href="' . route('article_edit', $article->id) . '"><i class="fa fa-pencil text-primary" aria-hidden="true"></i></a>
                 <a role="button" class="deleteButton" data-id="'. $article->id .'" onsubmit="return confirm(`Are you sure you want to delete this article?`);"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>';
            })
            ->make();
    }

    public function contactusdatatable()
    {
        $contacts = ContactUs::select(['id','name','email','subject','created_at'])->orderBy('created_at','desc');

        return Datatables::of($contacts)->make();
    }
}
