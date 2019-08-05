@extends('../includes.app')

@section('title') RealEstateOne | AboutUs @endsection

@section('navbar_background')
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url({{ $article->thumbnail }});" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-md-10">
                    <h1 class="mb-2">About RealEstateOne</h1>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <img src="images/about.jpg" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-5 ml-auto"  data-aos="fade-up" data-aos-delay="200">
                    <div class="site-section-title">
                        <h2>Our Company</h2>
                    </div>
                    <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus in cum odio./p>
                    <p>Illum repudiandae ratione facere explicabo. Consequatur dolor optio iusto, quos autem voluptate ea? Sunt laudantium fugiat, mollitia voluptate? Modi blanditiis veniam nesciunt architecto odit voluptatum tempore impedit magnam itaque natus!</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto consectetur odio quia voluptate. Alias aspernatur cumque distinctio, facere illo ipsum necessitatibus numquam officia qui repudiandae rerum soluta temporibus totam vitae!</p>
                </div>
            </div>
        </div>
    </div>
@endsection
