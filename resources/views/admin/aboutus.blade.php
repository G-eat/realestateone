@extends('layouts.app')

@section('content')
    <div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">About-us</div>

                    <div class="card-body">
                        <form action="{{ route('update.aboutus') }}" method="post" class="form-group">
                            @csrf
                            <label class="font-weight-bold" for="title">Title :</label>
                            <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Title" value="{{ (old('title')) ? old('title') : $aboutus->title }}">
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <label class="font-weight-bold mt-3" for="body">Body :</label>
                            <textarea name="body" id="body" rows="9" class="form-control @error('body') is-invalid @enderror" placeholder="Body ...">{{ (old('body')) ? old('body') : $aboutus->body }}</textarea>
                            @error('body')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <input type="submit" value="Update" class="btn btn-primary  py-2 px-4 rounded-0 mt-3">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
