@extends('layouts.app')

@section('content')
    <div>
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">Articles</div>
                    <div class="container">
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

