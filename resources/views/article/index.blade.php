@extends('../include.app')

@section('navbar_background')
    <div class="slide-one-item home-slider owl-carousel">
        <div class="site-blocks-cover overlay" style="background-image: url(images/hero_bg_1.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
            <div class="container">
                <div class="row align-items-center justify-content-center text-center">
                    <div class="col-md-10">
                        <span class="d-inline-block bg-success text-white px-3 mb-3 property-offer-type rounded">For Rent</span>
                        <h1 class="mb-2">871 Crenshaw Blvd</h1>
                        <p class="mb-5"><strong class="h2 text-success font-weight-bold">$2,250,500</strong></p>
                        <p><a href="#" class="btn btn-white btn-outline-white py-3 px-5 rounded-0 btn-2">See Details</a></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-blocks-cover overlay" style="background-image: url(images/hero_bg_2.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
            <div class="container">
                <div class="row align-items-center justify-content-center text-center">
                    <div class="col-md-10">
                        <span class="d-inline-block bg-danger text-white px-3 mb-3 property-offer-type rounded">For Sale</span>
                        <h1 class="mb-2">625 S. Berendo St</h1>
                        <p class="mb-5"><strong class="h2 text-success font-weight-bold">$1,000,500</strong></p>
                        <p><a href="#" class="btn btn-white btn-outline-white py-3 px-5 rounded-0 btn-2">See Details</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('search')
    <div class="site-section site-section-sm pb-0">
        <div class="container">
            <div class="row">
                <form class="form-search col-md-12" style="margin-top: -100px;">
                    <div class="row  align-items-end">
                        <div class="col-md-3">
                            <label for="list-types">Listing Types</label>
                            <div class="select-wrap">
                                <span class="icon icon-arrow_drop_down"></span>
                                <select name="list-types" id="list-types" class="form-control d-block rounded-0">
                                    <option value="">Condo</option>
                                    <option value="">Commercial Building</option>
                                    <option value="">Land Property</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="offer-types">Offer Type</label>
                            <div class="select-wrap">
                                <span class="icon icon-arrow_drop_down"></span>
                                <select name="offer-types" id="offer-types" class="form-control d-block rounded-0">
                                    <option value="">For Sale</option>
                                    <option value="">For Rent</option>
                                    <option value="">For Lease</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="select-city">Select City</label>
                            <div class="select-wrap">
                                <span class="icon icon-arrow_drop_down"></span>
                                <select name="select-city" id="select-city" class="form-control d-block rounded-0">
                                    <option value="">New York</option>
                                    <option value="">Brooklyn</option>
                                    <option value="">London</option>
                                    <option value="">Japan</option>
                                    <option value="">Philippines</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <input type="submit" class="btn btn-success text-white btn-block rounded-0" value="Search">
                        </div>
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="view-options bg-white py-3 px-3 d-md-flex align-items-center">
                        <div class="mr-auto">
                            <a href="index.html" class="icon-view view-module active"><span class="icon-view_module"></span></a>
                            <a href="view-list.html" class="icon-view view-list"><span class="icon-view_list"></span></a>
                        </div>
                        <div class="ml-auto d-flex align-items-center">
                            <div>
                                <a href="#" class="view-list px-3 border-right active">All</a>
                                <a href="#" class="view-list px-3 border-right">Rent</a>
                                <a href="#" class="view-list px-3">Sale</a>
                            </div>


                            <div class="select-wrap">
                                <span class="icon icon-arrow_drop_down"></span>
                                <select class="form-control form-control-sm d-block rounded-0">
                                    <option value="">Sort by</option>
                                    <option value="">Price Ascending</option>
                                    <option value="">Price Descending</option>
                                </select>
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
                            <a href="property-details.html" class="property-thumbnail">
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
                                <h2 class="property-title"><a href="property-details.html">{{ $article->city }}</a></h2>
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
