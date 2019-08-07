@extends('../includes.app')

@section('title') RealEstateOne | Search @endsection

@if($errors->any())
    <div class="alert alert-danger alert-dismissible mb-0">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        @foreach($errors->all() as $error)
            <span>{{ $error }}</span>
        @endforeach
    </div>
@endif

@section('navbar_background')
    <div class="slide-one-item home-slider owl-carousel">
        @foreach ($randomarticles as $article)
            <div class="site-blocks-cover overlay" style="background-image: url({{ $article->thumbnail }});" data-aos="fade" data-stellar-background-ratio="0.5">
                <div class="container">
                    <div class="row align-items-center justify-content-center text-center">
                        <div class="col-md-10">
                            @if ($article->for == 'sale')
                                <span class="d-inline-block bg-danger text-white px-3 mb-3 property-offer-type rounded">For Sale</span>
                            @else
                                <span class="d-inline-block bg-success text-white px-3 mb-3 property-offer-type rounded">For Rent</span>
                            @endif
                            <h1 class="mb-2">{{ $article->city }}</h1>
                            <small class="text-warning">{{ $article->address }}</small>
                            <p class="mb-2 mt-2"><strong class="h2 text-success font-weight-bold">{{ $article->price }}$</strong></p>
                            <p><a href="{{ route('article_show',['id' => $article->id]) }}" class="btn btn-white btn-outline-white py-3 px-5 rounded-0 btn-2">See Details</a></p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('search')
    @include('../includes/search')
@endsection

@section('content')

    <div class="site-section site-section-sm bg-light">
        <div class="container">

            <div class="row mb-5">
                @foreach ($articles as $article)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="property-entry h-100">
                            <a href="{{ route('article_show',['id' => $article->id]) }}" class="property-thumbnail">
                                <div class="offer-type-wrap">
                                    @if ($article->for == 'sale')
                                        <span class="offer-type bg-danger">Sale</span>
                                    @else
                                        <span class="offer-type bg-success">Rent</span>
                                    @endif
                                </div>
                                <img src="{{ $article->thumbnail }}" alt="Image" class="img-fluid">
                            </a>
                            <div class="p-4 property-body">
                                <h2 class="property-title"><a href="{{ route('article_show',['id' => $article->id]) }}">{{ $article->title }}</a></h2>
                                <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> {{ $article->address }}</span>
                                <strong class="property-price text-primary mb-3 d-block text-success">${{ $article->price }}</strong>
                                <ul class="property-specs-wrap mb-3 mb-lg-0">
                                    <li>
                                        <span class="property-specs">Type</span>
                                        <span class="property-specs-number">{{ $article->type }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($articles->appends(Request::all())->lastPage() > 1)
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="site-pagination">
                            @if($articles->appends(Request::all())->currentPage() >= 5 )
                                <a href="{{ $articles->appends(Request::all())->url(1) }}">{{ 1 }}</a>
                                <span>...</span>
                            @elseif ($articles->appends(Request::all())->currentPage() >= 4 )
                                <a href="{{ $articles->appends(Request::all())->url(1) }}">{{ 1 }}</a>
                            @endif

                            @for ($i = 1; $i <= $articles->appends(Request::all())->lastPage(); $i++)
                                <?php
                                $half_total_links = floor(7 / 2);
                                $from = $articles->appends(Request::all())->currentPage() - $half_total_links;
                                $to = $articles->appends(Request::all())->currentPage() + $half_total_links;
                                if ($articles->appends(Request::all())->currentPage() < $half_total_links) {
                                    $to += $half_total_links - $articles->appends(Request::all())->currentPage();
                                }
                                if ($articles->appends(Request::all())->lastPage() - $articles->appends(Request::all())->currentPage() < $half_total_links) {
                                    $from -= $half_total_links - ($articles->appends(Request::all())->lastPage() - $articles->appends(Request::all())->currentPage()) - 1;
                                }
                                ?>
                                @if ($from < $i && $i < $to)
                                    <a class="{{ ($articles->appends(Request::all())->currentPage() == $i) ? 'active':'' }}" href="{{ $articles->appends(Request::all())->url($i) }}">{{ $i }}</a>
                                @endif
                            @endfor

                            @if($articles->appends(Request::all())->currentPage() <= $articles->appends(Request::all())->lastPage()-4 )
                                <span>...</span>
                                <a href="{{ $articles->appends(Request::all())->url($articles->appends(Request::all())->lastPage()) }}">{{ $articles->appends(Request::all())->lastPage() }}</a>
                            @elseif ($articles->appends(Request::all())->currentPage() <= $articles->appends(Request::all())->lastPage()-3 )
                                <a href="{{ $articles->appends(Request::all())->url($articles->appends(Request::all())->lastPage()) }}">{{ $articles->appends(Request::all())->lastPage() }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif


        </div>
    </div>
@endsection
