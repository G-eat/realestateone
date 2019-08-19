@extends('client-includes.app')

@section('title') RealEstateOne | Home - List @endsection

@section('navbar_background')
    <div class="slide-one-item home-slider owl-carousel">
        @if(count($randomarticles) == 0)
            <div class="site-blocks-cover overlay" style="background-image: url({{ URL::asset('storage//photos/default.jpg') }});" data-aos="fade" data-stellar-background-ratio="0.5">
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
                <div class="site-blocks-cover overlay" style="background-image: url({{ URL::asset('storage//photos/'.$article->photo[0]->photo)}});;" data-aos="fade" data-stellar-background-ratio="0.5">
                    <div class="container">
                        <div class="row align-items-center justify-content-center text-center">
                            <div class="col-md-10">
                                @if ($article->for == 'sale')
                                    <span class="d-inline-block bg-danger text-white px-3 mb-3 property-offer-type rounded">For Sale</span>
                                @elseif ($article->for == 'rent')
                                    <span class="d-inline-block bg-success text-white px-3 mb-3 property-offer-type rounded">For Rent</span>
                                @else
                                    <div style="display: flex;flex-direction: column;max-width: 200px;align-items: center;margin: 40px auto 0;">
                                        <span class="d-inline-block bg-danger text-white px-3 mb-3 property-offer-type rounded">For Sale</span>
                                        <span class="d-inline-block bg-success text-white px-3 mb-3 property-offer-type rounded">For Rent</span>
                                    </div>
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
                                    <option value="sale" {{ old('offer-types') == 'sale' ? 'selected' : '' }}>For Sale</option>
                                    <option value="rent" {{ old('offer-types') == 'rent' ? 'selected' : '' }}>For Rent</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="select-city">City</label>
                            <div class="select-wrap">
                                <select name="city" class="form-control d-block rounded-0">
                                    <option value="">All</option>
                                    <option value="gjakove" {{ old('city') == 'gjakove' ? 'selected' : '' }}>Gjakove</option>
                                    <option value="prishtine" {{ old('city') == 'prishtine' ? 'selected' : '' }}>Prishtine</option>
                                    <option value="mitrovice" {{ old('city') == 'mitrovice' ? 'selected' : '' }}>Mitrovice</option>
                                    <option value="peje" {{ old('city') == 'peje' ? 'selected' : '' }}>Peje</option>
                                    <option value="prizren" {{ old('city') == 'prizren' ? 'selected' : '' }}>Prizren</option>
                                    <option value="gjilan" {{ old('city') == 'gjilan' ? 'selected' : '' }}>Gjilan</option>
                                    <option value="ferizaj" {{ old('city') == 'ferizaj' ? 'selected' : '' }}>Ferizaj</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="select-city">Type</label>
                            <div class="select-wrap">
                                <select name="type" class="form-control d-block rounded-0">
                                    <option value="">All</option>
                                    <option value="1+1" {{ old('type') == '1+1' ? 'selected' : '' }}>1 + 1</option>
                                    <option value="2+1" {{ old('type') == '2+1' ? 'selected' : '' }}>2 + 1</option>
                                    <option value="3+1" {{ old('type') == '3+1' ? 'selected' : '' }}>3 + 1</option>
                                    <option value="3+2" {{ old('type') == '3+2' ? 'selected' : '' }}>3 + 2</option>
                                    <option value="4+1" {{ old('type') == '4+1' ? 'selected' : '' }}>4 + 1</option>
                                    <option value="4+2" {{ old('type') == '4+2' ? 'selected' : '' }}>4 + 2</option>
                                    <option value="5+1" {{ old('type') == '5+1' ? 'selected' : '' }}>5 + 1</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <input type="submit" class="btn btn-success text-white btn-block rounded-0" value="Search">
                        </div>
                    </div>
                </form>
            </div>

            @if(Route::current()->getName() != 'article.search')
                <div class="row">
                    <div class="col-md-12">
                        <div class="view-options bg-white py-3 px-3 d-md-flex align-items-center">
                            <div class="mr-auto">
                                <a href="{{ route('article.all') }}" class="icon-view view-module {{ (Route::current()->getName() == 'article.all') ? 'active' : '' }}"><span class="icon-view_module"></span></a>
                                <a href="{{ route('article.all.list') }}" class="icon-view view-list {{ (Route::current()->getName() == 'article.all.list') ? 'active' : '' }}"><span class="icon-view_list"></span></a>
                            </div>
                            <div class="ml-auto d-flex align-items-center">
                                <div>
                                    @if(Route::current()->getName() == 'article.all')
                                        <a href="{{ route('article.all') }}" class="view-list px-3 border-right {{ ($sortby != 'most-viewed') ? 'active' : '' }}">Latest</a>
                                        <a href="{{ url('/card/most-viewed') }}" class="view-list px-3 border-right {{ ($sortby == 'most-viewed') ? 'active' : '' }}">Most Views</a>
                                    @else
                                        <a href="{{ route('article.all.list') }}" class="view-list px-3 border-right {{ ($sortby != 'most-viewed') ? 'active' : '' }}">Latest</a>
                                        <a href="{{ url('/list/most-viewed') }}" class="view-list px-3 border-right {{ ($sortby == 'most-viewed') ? 'active' : '' }}">Most Views</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('content')
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible mb-3 container">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <ul class="mt-3">
                @foreach($errors->all() as $error)
                    <li class="mb-2">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @else
        <div class="site-section site-section-sm bg-light">
            <div class="container">
                @if(count($articles) == 0)
                    <p class="alert alert-warning">No apartments for sale or rent.</p>
                @else
                    @foreach ($articles as $article)
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="property-entry horizontal d-lg-flex">
                                    <a href="{{ route('article.show',['id' => $article->id]) }}" class="property-thumbnail h-100">
                                        <div class="offer-type-wrap">
                                            @if ($article->for == 'sale')
                                                <span class="offer-type bg-danger">Sale</span>
                                            @elseif ($article->for == 'rent')
                                                <span class="offer-type bg-success">Rent</span>
                                            @else
                                                <span class="offer-type bg-danger">Sale</span>
                                                <span class="offer-type bg-success">Rent</span>
                                            @endif
                                        </div>
                                        <img src="{{ URL::asset('storage//photos/'.$article->photo[0]->photo) }}" alt="Image" class="img-fluid">
                                    </a>
                                    <div class="p-4 property-body">
                                        <h2 class="property-title"><a href="{{ route('article.show',['id' => $article->id]) }}">{{ $article->title }}</a></h2>
                                        <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span>{{ $article->city }} - {{ $article->address }}</span>
                                        <strong class="property-price text-primary mb-3 d-block text-success">{{ $article->price }}$</strong>
                                        <p>{{ $article->body }}</p>
                                        <ul class="property-specs-wrap mb-3 mb-lg-0">
                                            <li>
                                                <span class="property-specs">Type</span>
                                                <span class="property-specs-number">{{ $article->type }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                @if ($articles->lastPage() > 1)
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="site-pagination">
                                @if($articles->currentPage() >= 5 )
                                    <a href="{{ $articles->url(1) }}">{{ 1 }}</a>
                                    <span>...</span>
                                @elseif ($articles->currentPage() >= 4 )
                                    <a href="{{ $articles->url(1) }}">{{ 1 }}</a>
                                @endif

                                @for ($i = 1; $i <= $articles->lastPage(); $i++)
                                    <?php
                                    $half_total_links = floor(7 / 2);
                                    $from = $articles->currentPage() - $half_total_links;
                                    $to = $articles->currentPage() + $half_total_links;
                                    if ($articles->currentPage() < $half_total_links) {
                                        $to += $half_total_links - $articles->currentPage();
                                    }
                                    if ($articles->lastPage() - $articles->currentPage() < $half_total_links) {
                                        $from -= $half_total_links - ($articles->lastPage() - $articles->currentPage()) - 1;
                                    }
                                    ?>
                                    @if ($from < $i && $i < $to)
                                        <a class="{{ ($articles->currentPage() == $i) ? 'active':'' }}" href="{{ $articles->url($i) }}">{{ $i }}</a>
                                    @endif
                                @endfor

                                @if($articles->currentPage() <= $articles->lastPage()-4 )
                                    <span>...</span>
                                    <a href="{{ $articles->url($articles->lastPage()) }}">{{ $articles->lastPage() }}</a>
                                @elseif ($articles->currentPage() <= $articles->lastPage()-3 )
                                    <a href="{{ $articles->url($articles->lastPage()) }}">{{ $articles->lastPage() }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif
@endsection
