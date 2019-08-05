<div class="site-section site-section-sm pb-0">
    <div class="container">
        <div class="row">
            <form action="{{ route('article_search') }}" class="form-search col-md-12" style="margin-top: -100px;" method="GET">
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
                                <option value="sale">For Sale</option>
                                <option value="rent">For Rent</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="select-city">City</label>
                        <div class="select-wrap">
                            <select name="city" class="form-control d-block rounded-0">
                                <option value="">All</option>
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
                                <option value="">All</option>
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
        @if($errors->any())
            <div class="alert alert-danger mt-2">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                @foreach($errors->all() as $error)
                    <div style="padding: 5px">{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @if(Route::current()->getName() != 'article_search')
            <div class="row">
                <div class="col-md-12">
                    <div class="view-options bg-white py-3 px-3 d-md-flex align-items-center">
                        <div class="mr-auto">
                            <a href="{{ route('all_articles') }}" class="icon-view view-module {{ (Route::current()->getName() == 'all_articles') ? 'active' : '' }}"><span class="icon-view_module"></span></a>
                            <a href="{{ route('all_articles_view_list') }}" class="icon-view view-list {{ (Route::current()->getName() == 'all_articles_view_list') ? 'active' : '' }}"><span class="icon-view_list"></span></a>
                        </div>
                        <div class="ml-auto d-flex align-items-center">
                            <div>
                                <a href="{{ route('all_articles') }}" class="view-list px-3 border-right {{ ($sortby != 'most-viewed') ? 'active' : '' }}">Latest</a>
                                <a href="{{ url('/card/most-viewed') }}" class="view-list px-3 border-right {{ ($sortby == 'most-viewed') ? 'active' : '' }}">Most Views</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
