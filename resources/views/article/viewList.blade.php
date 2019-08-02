@extends('../includes.app')

@section('title') RealEstateOne | Home - List @endsection

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
    <div class="site-section site-section-sm pb-0">
        <div class="container">
            <div class="row">
                <form class="form-search col-md-12" style="margin-top: -100px;">
                    <div class="row  align-items-end">
                        <div class="col-md-2">
                            <label for="list-types">Price</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">From</span>
                                </div>
                                <input type="text" name='price_from' class="form-control" placeholder="e.g. 200">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">To</span>
                                </div>
                                <input type="text" name='price_to' class="form-control" placeholder="e.g. 300">
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
                                    <option value="all">All</option>
                                    <option value="sale">For Sale</option>
                                    <option value="rent">For Rent</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="select-city">City</label>
                            <div class="select-wrap">
                                <select name="city" class="form-control d-block rounded-0">
                                    <option value="all">All</option>
                                    <option value="gjakove">Gjakove</option>
                                    <option value="prishtine">Prishtine</option>
                                    <option value="mitrovice">Mitrovice</option>
                                    <option value="peje">Peje</option>
                                    <option value="prizren">Prizren</option>
                                    <option value="gjilan">Gjilan</option>
                                    <option value="ferizaj">Ferizaj</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="select-city">Type</label>
                            <div class="select-wrap">
                                <select name="type" class="form-control d-block rounded-0">
                                    <option value="all">All</option>
                                    <option value="1+1">1 + 1</option>
                                    <option value="2+1">2 + 1</option>
                                    <option value="3+1">3 + 1</option>
                                    <option value="3+2">3 + 2</option>
                                    <option value="4+1">4 + 1</option>
                                    <option value="4+2">4 + 2</option>
                                    <option value="5+1">5 + 1</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <input type="submit" class="btn btn-success text-white btn-block rounded-0" value="Search">
                        </div>
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="view-options bg-white py-3 px-3 d-md-flex align-items-center">
                        <div class="mr-auto">
                            <a href="{{ route('all_articles') }}" class="icon-view view-module"><span class="icon-view_module"></span></a>
                            <a href="{{ route('all_articles_view_list') }}" class="icon-view view-list active"><span class="icon-view_list"></span></a>
                        </div>
                        <div class="ml-auto d-flex align-items-center">
                            <div>
                                <a href="{{ url('/list') }}" class="view-list px-3 border-right {{ ($sortby != 'most-viewed') ? 'active' : '' }}">Latest</a>
                                <a href="{{ url('/list/most-viewed') }}" class="view-list px-3 border-right {{ ($sortby == 'most-viewed') ? 'active' : '' }}">Most Views</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="site-section site-section-sm bg-light">
        <div class="container">
            @foreach ($articles as $article)
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="property-entry horizontal d-lg-flex">
                            <a href="{{ route('article_show',['id' => $article->id]) }}" class="property-thumbnail h-100">
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
                                <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span>{{ $article->address }}</span>
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

            <span>Page :</span>{{ $articles->onEachSide(5)->links() }}

            <!-- {{ $articles->appends(['sort' => 'created_at'])->links() }} -->
            <!-- <div class="row">
                <div class="col-md-12 text-center">
                    <div class="site-pagination">
                        <a href="#" class="active">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#">4</a>
                        <a href="#">5</a>
                        <span>...</span>
                        <a href="#">10</a>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
@endsection
