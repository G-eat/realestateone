@extends('dashboard-includes.app')

@section('title') RealEstateOne | @can('admin') All-Articles @elsecan('user') My-Articles @endcan @endsection

@section('content')
    <div>
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">Articles</div>
                    <div class="container">
                        <a class="btn btn-primary mt-2 mb-2" style="float: right" href="{{ route('article.create') }}">Create</a>
                        <div class="card-body">
                            <table class="table table-bordered" id="articles-table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>City</th>
                                        <th>Address</th>
                                        <th>Type</th>
                                        <th>Phone Number</th>
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


