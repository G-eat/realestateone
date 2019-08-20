@extends('admin-includes.app')

@section('title') RealEstateOne | Admin-ContactUs @endsection

@section('content')
    <div>
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">Title : {{ $article->title }}</div>
                    <div class="card-footer">
                        Body : {{ $article->body }}
                    </div>
                    <div class="card-footer">
                        City : {{ $article->city }}
                    </div>
                    <div class="card-footer">
                        Address : {{ $article->address }}
                    </div>
                    <div class="card-footer">
                        For : {{ $article->for }}
                    </div>
                    <div class="card-footer">
                        Price : {{ $article->price }}
                    </div>
                    <div class="card-footer">
                        Views : {{ $article->views }}
                    </div>
                    <div class="card-footer">
                        Type : {{ $article->type }}
                    </div>
                    <div class="card-footer">
                        Available :
                        @if( $article->available )
                            Yes
                        @else
                            No
                        @endif
                    </div>
                    <div class="card-footer">
                        Phone Nr. : {{ $article->phonenumber }}
                    </div>
                    <div class="card-footer">
                        Created : {{ $article->created_at }}
                    </div>
                    <div class="card-footer">
                        Updated : {{ $article->updated_at }}
                    </div>
                </div>
                <a class="btn btn-secondary mt-2" href="{{ route('articles') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                <div style="float: right">
                    <a class="btn btn-secondary mt-2" href="{{ route('article.edit', $article->id) }}">Edit</a>
                    <a class="btn btn-secondary mt-2" href="{{ route('article.show', $article->id) }}">Show</a>
                </div>
            </div>
        </div>
    </div>
@endsection
