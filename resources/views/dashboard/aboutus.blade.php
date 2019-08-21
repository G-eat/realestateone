@extends('dashboard-includes.app')

@section('title') RealEstateOne | Admin-{{ __('navbar.about') }} @endsection

@section('content')
    <div>
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">{{ __('navbar.about') }}</div>

                    <div class="card-body">
{{--                            <form action="{{ route('aboutus.update') }}" method="post" class="form-group">--}}
{{--                                @csrf--}}
                        <label class="font-weight-bold" for="title">{{ __('pannel.title') }} :</label>
                        <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Title" value="{{ (old('title')) ? old('title') : $aboutus->title }}">
                        {{--                            @error('title')--}}
                        {{--                            <span class="invalid-feedback" role="alert">--}}
                        {{--                                <strong>{{ $message }}</strong>--}}
                        {{--                            </span>--}}
                        {{--                            @enderror--}}
                        <label class="font-weight-bold mt-3" for="body">{{ __('pannel.body') }} :</label>
                        <textarea name="body" id="body" rows="6" class="form-control @error('body') is-invalid @enderror" placeholder="Body ...">{{ (old('body')) ? old('body') : $aboutus->body }}</textarea>
                        {{--                            @error('body')--}}
                        {{--                            <span class="invalid-feedback" role="alert">--}}
                        {{--                                <strong>{{ $message }}</strong>--}}
                        {{--                            </span>--}}
                        {{--                            @enderror--}}
                        <input id="update" type="submit" value="{{ __('pannel.update') }}" class="btn btn-primary  py-2 px-4 rounded-0 mt-3">
                        {{--                        </form>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('only_one_page_js')
    <script>
        $("#update").on("click", function () {
            var title = $('#title').val();
            var body = $('#body').val();

            var num = 1;

            if ( body.trim().length > 480 ) {
                toastr.error('Body is too long.', 'Inconceivable!', {timeOut: 5000});
                num = 0;
            } else if (!body.trim()) {
                toastr.error('Body is required.', 'Inconceivable!', {timeOut: 5000});
                num = 0;
            }

            if ( title.trim().length > 191 ) {
                toastr.error('Title is too long.', 'Inconceivable!', {timeOut: 5000});
                num = 0;
            } else if (!title.trim()) {
                toastr.error('Title is required.', 'Inconceivable!', {timeOut: 5000});
                num = 0;
            }


            if (num) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax(
                    {
                        url: "/update/about-us",
                        type: 'PUT',
                        dataType: 'html',
                        data:{
                            title: title,
                            body:body
                        },
                        success: function (response)
                        {
                            if(response == 'Success') {
                                toastr.success('You updated about-us.', 'Success Alert', {timeOut: 5000});
                            } else if(response == 'Empty'){
                                toastr.error('Title and body are required.', 'Inconceivable!', {timeOut: 5000});
                            } else {
                                toastr.warning('You didnt change anything.', 'Inconceivable!', {timeOut: 5000});
                            }
                        },
                        error: function(xhr) {
                            toastr.error('Something goes wrong, please try again after some minutes.', 'Inconceivable!', {timeOut: 5000});
                        }
                    });

            }
        });
    </script>
@endsection
