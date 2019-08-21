@extends('dashboard-includes.app')

@section('title') RealEstateOne @endsection

@section('content')
    <div>
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">{{ __('pannel.title') }} : {{ $article->title }}</div>
                    @can('admin')
                        <div class="card-footer">
                            ID : {{ $article->user_id }}
                        </div>
                        <div class="card-footer">
                            {{ __('pannel.name') }} : {{ $article->user->name }}
                        </div>
                    @endcan
                    <div class="card-footer">
                        {{ __('pannel.body') }} : {{ $article->body }}
                    </div>
                    <div class="card-footer">
                        {{ __('home_details.city') }} : {{ $article->city }}
                    </div>
                    <div class="card-footer">
                        {{ __('home_details.address') }} : {{ $article->address }}
                    </div>
                    <div class="card-footer">
                        {{ __('home_details.for') }} : {{ $article->for }}
                    </div>
                    <div class="card-footer">
                        {{ __('home_details.price') }} : {{ $article->price }}
                    </div>
                    <div class="card-footer">
                        {{ __('home_details.viws') }} : {{ $article->views }}
                    </div>
                    <div class="card-footer">
                        {{ __('home_details.type') }} : {{ $article->type }}
                    </div>
                    <div class="card-footer">
                        {{ __('home_details.available') }} :
                        @if( $article->available )
                            {{ __('home_details.yes') }}
                        @else
                            {{ __('home_details.no') }}
                        @endif
                    </div>
                    <div class="card-footer">
                        {{ __('home_details.number') }} : {{ $article->phonenumber }}
                    </div>
                    <div class="card-footer">
                        {{ __('home_details.created') }} : {{ $article->created_at }}
                    </div>
                    <div class="card-footer">
                        {{ __('home_details.updated') }} : {{ $article->updated_at }}
                    </div>
                </div>
                <a class="btn btn-secondary mt-2" href="{{ route('articles') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ __('home_details.back') }}</a>
                <div style="float: right">
                    <a class="btn btn-secondary mt-2" href="{{ route('article.edit', $article->id) }}">{{ __('home_details.edit') }}</a>
                    <a class="btn btn-secondary mt-2" href="{{ route('article.show', $article->id) }}">{{ __('home_details.show') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
