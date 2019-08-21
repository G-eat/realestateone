@extends('client-includes.app')

@section('title') RealEstateOne | {{ __('navbar.contact') }} @endsection

@section('navbar_background')
{{--    @if(!$article)--}}
        <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url('https://iciimg.us/resources/movein/move-in-ready-large.jpg');" data-aos="fade" data-stellar-background-ratio="0.5">
            <div class="container">
                <div class="row align-items-center justify-content-center text-center">
                    <div class="col-md-10">
                        <h1 class="mb-2">{{ __('navbar.contact') }}</h1>
                    </div>
                </div>
            </div>
        </div>
{{--    @else--}}
{{--        <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url({{ URL::asset('storage//photos/'.$article->photo[0]->photo)}});" data-aos="fade" data-stellar-background-ratio="0.5">--}}
{{--            <div class="container">--}}
{{--                <div class="row align-items-center justify-content-center text-center">--}}
{{--                    <div class="col-md-10">--}}
{{--                        <h1 class="mb-2">Contact Us</h1>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endif--}}
@endsection

@section('content')
    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8 mb-5">
                    <form action="{{ route('send.message') }}" class="p-5 bg-white border" method="post">
{{--                        @csrf--}}
                        <div class="row form-group">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="font-weight-bold" for="fullname">{{ __('contact_us.name') }}</label>
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('contact_us.name') }}" value="{{ old('name') }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="font-weight-bold" for="email">{{ __('contact_us.email') }}</label>
                                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('contact_us.email') }}" value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="font-weight-bold" for="email">{{ __('contact_us.subject') }}</label>
                                <input type="text" id="subject" name="subject" class="form-control @error('subject') is-invalid @enderror" placeholder="{{ __('contact_us.subject') }}" value="{{ old('subject') }}">
                                @error('subject')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="font-weight-bold" for="message">{{ __('contact_us.message') }}</label>
                                <textarea name="content" id="content"  cols="30" rows="5" class="form-control @error('content') is-invalid @enderror" placeholder="{{ __('contact_us.message') }}">{{ old('content') }}</textarea>
                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="submit" value="{{ __('contact_us.send') }}" class="btn btn-primary  py-2 px-4 rounded-0">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="p-4 mb-3 bg-white">
                        <h3 class="h6 text-black mb-3 text-uppercase">Contact Info</h3>
                        <p class="mb-0 font-weight-bold">Address</p>
                        <p class="mb-4">203 Fake St. Mountain View, San Francisco, California, USA</p>
                        <p class="mb-0 font-weight-bold">Phone</p>
                        <p class="mb-4"><a href="#">+1 232 3235 324</a></p>
                        <p class="mb-0 font-weight-bold">Email Address</p>
                        <p class="mb-0"><a href="#">youremail@domain.com</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
