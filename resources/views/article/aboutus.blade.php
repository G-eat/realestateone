@extends('client-includes.app')

@section('title') RealEstateOne | AboutUs @endsection

@section('navbar_background')
    @if(!$article)
        <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url({{ '/storage/photos/default.jpg' }});" data-aos="fade" data-stellar-background-ratio="0.5">
            <div class="container">
                <div class="row align-items-center justify-content-center text-center">
                    <div class="col-md-10">
                        <h1 class="mb-2">About RealEstateOne</h1>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url({{ '/storage/photos/'.$article->photo[0]->photo }});" data-aos="fade" data-stellar-background-ratio="0.5">
            <div class="container">
                <div class="row align-items-center justify-content-center text-center">
                    <div class="col-md-10">
                        <h1 class="mb-2">About RealEstateOne</h1>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('content')
    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <img src="/storage/photos/about.jpg" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-5 ml-auto"  data-aos="fade-up" data-aos-delay="200">
                    @if(!$about_us)
                        <div class="site-section-title">
                            <h2>About US</h2>
                        </div>
                        <p class="lead">Nothing there.</p>
                    @else
                        <div class="site-section-title">
                            <h2>{{ $about_us->title }}</h2>
                        </div>
                        <p class="lead">{{ $about_us->body }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
