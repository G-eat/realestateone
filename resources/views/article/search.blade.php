@extends('client-includes.app')

@section('title') RealEstateOne | Search @endsection

@section('navbar_background')
    <div class="slide-one-item home-slider owl-carousel">
        @if(count($randomarticles) == 0)
            <div class="site-blocks-cover overlay" style="background-image: url({{ '/storage/photos/default.jpg' }});" data-aos="fade" data-stellar-background-ratio="0.5">
                <div class="container">
                    <div class="row align-items-center justify-content-center text-center">
                        <div class="col-md-10">
                            <h1 class="mb-2">Index</h1>
                        </div>
                    </div>
                </div>
            </div>
        @else
            @foreach ($randomarticles as $article)
                <div class="site-blocks-cover overlay" style="background-image: url({{ '/storage/photos/'.$article->photo[0]->path }});" data-aos="fade" data-stellar-background-ratio="0.5">
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
                                <p><a href="{{ route('article.show',['id' => $article->id]) }}" class="btn btn-white btn-outline-white py-3 px-5 rounded-0 btn-2">See Details</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection

@section('search')
    <div class="site-section site-section-sm pb-0">
        <div class="container">
            <div class="row">
                <form action="{{ route('article.search') }}" class="form-search col-md-12" style="margin-top: -100px;" method="GET">
                    <div class="row  align-items-end">
                        <div class="col-md-2">
                            <label for="list-types">Price</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">From</span>
                                </div>
                                <input type="text" name='price_from' class="form-control" placeholder="e.g. 200" value="{{ !isset($price_from) ? old('price_from') : $price_from }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">To</span>
                                </div>
                                <input type="text" name='price_to' class="form-control" placeholder="e.g. 300" value="{{ !isset($price_to) ? old('price_to') : $price_to }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">$</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="offer-types">Offer Type</label>
                            <div class="select-wrap">
                                <span class="icon icon-arrow_drop_down"></span>
                                <select name="offer-types" id="offer-types" class="form-control d-block rounded-0">
                                    <option value="">All</option>
                                    <option value="sale" {{ $for == 'sale' ? 'selected' : '' }}>For Sale</option>
                                    <option value="rent" {{ $for == 'rent' ? 'selected' : '' }}>For Rent</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="select-city">City</label>
                            <div class="select-wrap">
                                <select name="city" class="form-control d-block rounded-0">
                                    <option value="">All</option>
                                    <option value="gjakove" {{ $city == 'gjakove' ? 'selected' : '' }}>Gjakove</option>
                                    <option value="prishtine" {{ $city == 'prishtine' ? 'selected' : '' }}>Prishtine</option>
                                    <option value="mitrovice" {{ $city == 'mitrovice' ? 'selected' : '' }}>Mitrovice</option>
                                    <option value="peje" {{ $city == 'peje' ? 'selected' : '' }}>Peje</option>
                                    <option value="prizren" {{ $city == 'prizren' ? 'selected' : '' }}>Prizren</option>
                                    <option value="gjilan" {{ $city == 'gjilan' ? 'selected' : '' }}>Gjilan</option>
                                    <option value="ferizaj" {{ $city == 'ferizaj' ? 'selected' : '' }}>Ferizaj</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="select-city">Type</label>
                            <div class="select-wrap">
                                <select name="type" class="form-control d-block rounded-0">
                                    <option value="">All</option>
                                    <option value="1+1" {{ $type == '1+1' ? 'selected' : '' }}>1 + 1</option>
                                    <option value="2+1" {{ $type == '2+1' ? 'selected' : '' }}>2 + 1</option>
                                    <option value="3+1" {{ $type == '3+1' ? 'selected' : '' }}>3 + 1</option>
                                    <option value="3+2" {{ $type == '3+2' ? 'selected' : '' }}>3 + 2</option>
                                    <option value="4+1" {{ $type == '4+1' ? 'selected' : '' }}>4 + 1</option>
                                    <option value="4+2" {{ $type == '4+2' ? 'selected' : '' }}>4 + 2</option>
                                    <option value="5+1" {{ $type == '5+1' ? 'selected' : '' }}>5 + 1</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <input type="submit" class="btn btn-success text-white btn-block rounded-0" value="Search">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible mb-3 container mt-3">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <ul class="mt-3">
                @foreach($errors->all() as $error)
                    <li class="mb-2">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br>
    @else
        <div class="site-section site-section-sm bg-light">
            <div class="container">
                @if(count($articles) == 0)
                    <p class="alert alert-warning">No apartments for sale or rent.</p>
                @else
                    <div class="row mb-5">
                        @foreach ($articles as $article)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="property-entry h-100">
                                    <a href="{{ route('article.show',['id' => $article->id]) }}" class="property-thumbnail">
                                        <div class="offer-type-wrap">
                                            @if ($article->for == 'sale')
                                                <span class="offer-type bg-danger">Sale</span>
                                            @else
                                                <span class="offer-type bg-success">Rent</span>
                                            @endif
                                        </div>
                                        <img src="{{ '/storage/photos/'.$article->photo[0]->path }}" alt="Image" class="img-fluid">
                                    </a>
                                    <div class="p-4 property-body">
                                        <h2 class="property-title"><a href="{{ route('article.show',['id' => $article->id]) }}">{{ $article->title }}</a></h2>
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
                @endif

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
    @endif
@endsection
