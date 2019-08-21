<div class="slide-one-item home-slider owl-carousel">
    @foreach ($randomarticles as $article)
        <div class="site-blocks-cover overlay" style="background-image: url({{ $article->thumbnail }});" data-aos="fade" data-stellar-background-ratio="0.5">
            <div class="container">
                <div class="row align-items-center justify-content-center text-center">
                    <div class="col-md-10">
                        @if ($article->for == 'sale')
                            <span class="d-inline-block bg-danger text-white px-3 mb-3 property-offer-type rounded">{{ __('home_details.for sale') }}</span>
                        @else
                            <span class="d-inline-block bg-success text-white px-3 mb-3 property-offer-type rounded">{{ __('home_details.for rent') }}</span>
                        @endif
                        <h1 class="mb-2">{{ $article->city }}</h1>
                        <small class="text-warning">{{ $article->address }}</small>
                        <p class="mb-2 mt-2"><strong class="h2 text-success font-weight-bold">{{ $article->price }}$</strong></p>
                        <p><a href="#" class="btn btn-white btn-outline-white py-3 px-5 rounded-0 btn-2">{{ __('home_details.details') }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
