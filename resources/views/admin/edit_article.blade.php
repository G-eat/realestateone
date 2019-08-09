@extends('layouts.app')

@section('content')
    <div>
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">Edit</div>
                    <div class="container">
                        <div class="card-body">
                            {{ $article->id }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


