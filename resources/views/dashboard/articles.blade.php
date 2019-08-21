@extends('dashboard-includes.app')

@section('title') RealEstateOne | @can('admin') All-Articles @elsecan('user') My-Articles @endcan @endsection

@section('content')
    <div>
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">{{ __('pannel.articles') }}</div>
                    <div class="container">
                        <a class="btn btn-primary mt-2 mb-2" style="float: right" href="{{ route('article.create') }}">{{ __('pannel.create') }}</a>
                        <div class="card-body">
                            <table class="table table-bordered" id="articles-table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>{{ __('home_details.city') }}</th>
                                        <th>{{ __('home_details.address') }}</th>
                                        <th>{{ __('home_details.type') }}</th>
                                        <th>{{ __('home_details.number') }}</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('only_one_page_js')
    <script src="../js/articlesdatatable.js"></script>
@endsection


