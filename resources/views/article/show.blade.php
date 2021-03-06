@extends('client-includes.app')

@section('title') RealEstateOne | {{ $article->title }} @endsection

@section('navbar_background')
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url({{ URL::asset('storage//photos/'.$article->photo[0]->photo)}});" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-md-10">
                    <p class="mb-5"><strong class="h2 text-success font-weight-bold">{{ $article->views }} {{ __('home_details.viws')}}</strong></p>
                    <h1 class="mb-2">{{ $article->city }}</h1>
                    <p class="mb-5"><strong class="h2 text-success font-weight-bold">{{ $article->price }}$</strong></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="site-section site-section-sm">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div>
                        <div class="slide-one-item home-slider owl-carousel">
                            @foreach ($photos as $photo)
                                <div><img src="{{ URL::asset('storage//photos/'.$photo->photo) }}" alt="Image" class="img-fluid"></div>
                            @endforeach
                        </div>
                    </div>
                    <div class="bg-white property-body border-bottom border-left border-right">
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <strong class="text-success h1 mb-3">{{ $article->price }}$</strong>
                            </div>
                            <div class="col-md-6">
                                <ul class="property-specs-wrap mb-3 mb-lg-0  float-lg-right">
                                    <li>
                                        @if (!$article->available)
                                            <span class="d-inline-block bg-danger text-white px-3 mb-3 property-offer-type rounded">Not available</span>
                                        @else
                                            @if ($article->for == 'sale')
                                                <span class="d-inline-block bg-danger text-white px-3 mb-3 property-offer-type rounded">{{ __('home_details.for sale')}}</span>
                                            @elseif ($article->for == 'rent')
                                                <span class="d-inline-block bg-success text-white px-3 mb-3 property-offer-type rounded">{{ __('home_details.for rent')}}</span>
                                            @else
                                                <span class="d-inline-block bg-danger text-white px-3 mb-3 property-offer-type rounded">{{ __('home_details.for sale')}}</span>
                                                <span class="d-inline-block bg-success text-white px-3 mb-3 property-offer-type rounded">{{ __('home_details.for rent')}}</span>
                                            @endif
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6 col-lg-3 text-center border-bottom border-top py-3">
                                <span class="d-inline-block text-black mb-0 caption-text">{{ __('home_details.type')}}</span>
                                <strong class="d-block">{{ $article->type }}</strong>
                            </div>
                            <div class="col-md-6 col-lg-3 text-center border-bottom border-top py-3">
                                <span class="d-inline-block text-black mb-0 caption-text">{{ __('home_details.city')}}</span>
                                <strong class="d-block">{{ ucfirst($article->city) }}</strong>
                            </div>
                            <div class="col-md-6 col-lg-3 text-center border-bottom border-top py-3">
                                <span class="d-inline-block text-black mb-0 caption-text">{{ __('home_details.address')}}</span>
                                <strong class="d-block">{{ $article->address }}</strong>
                            </div>
                            <div class="col-md-6 col-lg-3 text-center border-bottom border-top py-3">
                                <span class="d-inline-block text-black mb-0 caption-text">{{ __('home_details.number')}}</span>
                                <strong class="d-block">{{ $article->phonenumber }}</strong>
                            </div>
                        </div>
                        <h2 class="h4 text-black">{{ $article->title }}</h2>
                        <p>{{ $article->body }}</p>

                        <div class="row no-gutters mt-5">
                            <div class="col-12">
                                <h2 class="h4 text-black mb-3">{{ __('home_details.gallery')}}</h2>
                            </div>
                            @foreach ($photos as $photo)
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <a href="{{ URL::asset('storage//photos/'.$photo->photo) }}" class="image-popup gal-item"><img src="{{ URL::asset('storage//photos/'.$photo->photo) }}" alt="Image" class="img-fluid"></a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="bg-white widget border rounded">
                        <h3 class="h4 text-black widget-title mb-3">Paragraph</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit qui explicabo, libero nam, saepe eligendi. Molestias maiores illum error rerum. Exercitationem ullam saepe, minus, reiciendis ducimus quis. Illo, quisquam, veritatis.</p>
                    </div>
                </div>

                @if(count($related_articles))
                    <div class="col-12 mt-5">
                        <div class="site-section-title mb-5">
                            <h2>{{ __('home_details.related')}}</h2>
                        </div>
                    </div>
                @else
                    <div class="mt-5 col-12">
                        <p class="alert alert-warning">{{ __('home_details.not_related')}}</p>
                    </div>
                @endif

                <div class="row mb-5">
                    @foreach($related_articles as $article)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="property-entry h-100">
                                <a href="{{ route('article.show',$article->id) }}" class="property-thumbnail">
                                    <div class="offer-type-wrap">
                                        @if ($article->for == 'sale')
                                            <span class="offer-type bg-danger">{{ __('home_details.sale')}}</span>
                                        @elseif ($article->for == 'rent')
                                            <span class="offer-type bg-success">{{ __('home_details.rent')}}</span>
                                        @else
                                            <span class="offer-type bg-danger">{{ __('home_details.sale')}}</span>
                                            <span class="offer-type bg-success">{{ __('home_details.rent')}}</span>
                                        @endif
                                    </div>
                                    <img src="{{ URL::asset('storage//photos/'.$article->photo[0]->photo) }}" alt="Image" class="img-fluid">
                                </a>
                                <div class="p-4 property-body">
                                    <h2 class="property-title"><a href="property-details.html">{{ $article->title }}</a></h2>
                                    <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span>{{ $article->city }} - {{ $article->address }}</span>
                                    <strong class="property-price text-primary mb-3 d-block text-success">${{ $article->price }}</strong>
                                    <ul class="property-specs-wrap mb-3 mb-lg-0">
                                        <li>
                                            <span class="property-specs">{{ __('home_details.type')}}</span>
                                            <span class="property-specs-number">{{ $article->type }}</span>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection
