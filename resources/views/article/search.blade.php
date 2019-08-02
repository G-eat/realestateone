@extends('../includes.app')

@section('title') RealEstateOne | Search @endsection

@section('search')
    <div class="site-section site-section-sm pb-0">
        <div class="container">
            <div class="row">
                <form action="{{ route('article_search') }}" class="form-search col-md-12" style="margin-top: -100px;">
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
                            <a href="{{ route('all_articles') }}" class="icon-view view-module active"><span class="icon-view_module"></span></a>
                            <a href="{{ route('all_articles_view_list') }}" class="icon-view view-list"><span class="icon-view_list"></span></a>
                        </div>
                        <div class="ml-auto d-flex align-items-center">
                            <div>
                                <a href="{{ route('all_articles') }}" class="view-list px-3 border-right">Latest</a>
                                <a href="{{ url('/card/most-viewed') }}" class="view-list px-3 border-right">Most Views</a>
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

            <span>Page :</span>{{ $articles->onEachSide(5)->links() }}

        </div>
    </div>
@endsection
