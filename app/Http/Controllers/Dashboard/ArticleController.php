<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Controllers\Controller;
use App\Photo;
use Faker\Provider\File;
use Illuminate\Http\Request;
use App\Article;
use App\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Auth;

class ArticleController extends Controller
{
    public function articles ()
    {
        return view('dashboard.articles');
    }

    public function create () {
        return view('dashboard.create_article');
    }

    public function edit ($id)
    {
        $article = $this->checkIfHasArticlePermission($id);
        return view('dashboard.edit_article')->with('article',$article);
    }

    public function show ($id) {

        $article = $this->checkIfHasArticlePermission($id);

        return view('dashboard.article_show')
            ->with('article', $article);
    }

    public function store (CreateArticleRequest $request)
    {
        foreach($request->file('filenames') as $file)
        {
            $name=time() . '-' . $file->getClientOriginalName();
            $file->storeAs('public/photos' , $name);
            $data[] = $name;
        }

        $article = Article::create([
            'user_id'       => \Illuminate\Support\Facades\Auth::user()->id,
            'title'         => $request->input('title'),
            'body'          => $request->input('body'),
            'city'          => $request->input('city'),
            'address'       => $request->input('address'),
            'for'           => $request->input('for'),
            'price'         => $request->input('price'),
            'type'          => $request->input('type'),
            'available'     => $request->input('available'),
            'phonenumber'   => $request->input('phone_number'),
        ]);

        $first_photo = $data[0];


        foreach ($data as $photo_name) {
            $photo = new Photo();
            $photo->article_id = $article->id;
            $photo->photo = $photo_name;
            if ($first_photo === $photo_name) {
                $photo->is_thumbnail = 1;
            } else {
                $photo->is_thumbnail = 0;
            }
            $photo->save();
        }

        $notification = [
            'message' => 'You created new article!',
            'alert-type' => 'success'
        ];

        return redirect('/articles') ->with($notification);
    }

    public function articlesdatatable()
    {
        if (Gate::allows('admin')) {
            $articles = Article::select(['id','title','city','address','type','phonenumber']);
        } elseif (Gate::allows('user')) {
            $user = Auth::user();
            $articles = Article::where('user_id','=',$user->id)->select(['id','title','city','address','type','phonenumber']);
        }

        return Datatables::of($articles)
            ->editColumn('action', function($article) {
                return
                    '<a href="' . route('admin.article_show', $article->id) . '" target="_blank"><i class="fa fa-eye text-success" aria-hidden="true"></i></a>
                 <a href="' . route('article.edit', $article->id) . '"><i class="fa fa-pencil text-primary" aria-hidden="true"></i></a>
                 <a role="button" class="deleteButton" data-id="'. $article->id .'"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>';
            })
            ->make();
    }

    public function update(UpdateArticleRequest $request, $id)
    {
        if (Gate::allows('admin')) {
            $article = Article::findorFail($id);
        } elseif (Gate::allows('user')) {
            $article = Article::where('user_id','=',Auth::user()->id)->findorFail($id);
        }

        $changes = $this->change($request->except('filenames'),$article);
        $allchanges = $this->change($request->all(),$article);


        if (!$allchanges){
            $notification = [
                'message' => "You didnt change anything in article!",
                'alert-type' => 'warning'
            ];

            return redirect('/articles') ->with($notification);
        } else {
            if ($changes)
            {
                Article::where('id', $id)->update($changes);
            }

            if($request->file('filenames') > 0)
            {
                $this->destroyOldPhotos($id);


                foreach($request->file('filenames') as $file)
                {
                    $photo = new Photo();
                    $photo->article_id = $article->id;

                    $name=time() . '-' . $file->getClientOriginalName();
                    $file->storeAs('public/photos' , $name);
                    $data[] = $name;
                }

                $first_photo = $data[0];

                foreach ($data as $photo_name) {
                    $photo = new Photo();
                    $photo->article_id = $article->id;
                    $photo->photo = $photo_name;
                    if ($first_photo === $photo_name) {
                        $photo->is_thumbnail = 1;
                    } else {
                        $photo->is_thumbnail = 0;
                    }
                    $photo->save();
                }
            }

            $notification = [
                'message' => 'You updated an article!',
                'alert-type' => 'success'
            ];

            return redirect('/articles') ->with($notification);
        }
    }
    public function change($data,$article)
    {
        $article->fill($data);
        $changes = $article->getDirty();
        if (count($changes) == 0) {
            return false;
        } else {
            return $changes;
        }
    }
    public function destroyOldPhotos($id)
    {
        $article = Article::findOrFail($id);
        $photos = $article->photo;

        foreach ($photos as $photo)
        {
            Storage::delete('public/photos/'.$photo->photo);
        }

        Photo::where('article_id',$article->id)->delete();
    }

    public function destroy ($id)
    {
        $article = $this->checkIfHasArticlePermission($id);
        $photos = $article->photo;

        foreach ($photos as $photo)
        {
            Storage::delete('public/photos/'.$photo->photo);
        }

        Photo::where('article_id',$article->id)->delete();

        $article->delete();
    }

    public function checkIfHasArticlePermission($id)
    {
        if (Gate::allows('admin')) {
            $article = Article::findorFail($id);
        } elseif (Gate::allows('user')) {
            $article = Article::where('user_id',Auth::user()->id)->findorFail($id);
        }

        return $article;
    }

}
