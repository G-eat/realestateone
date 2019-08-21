@extends('dashboard-includes.app')

@section('title') RealEstateOne | Admin-{{ __('navbar.contact') }} @endsection

@section('content')
    <div>
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">Contact-us</div>
                    <div class="container">
                        <div class="card-body">
                            <table class="table table-bordered" id="contactsus-table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>{{ __('contact_us.name') }}</th>
                                        <th>{{ __('contact_us.email') }}</th>
                                        <th>{{ __('contact_us.subject') }}</th>
                                        <th>Created At</th>
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
    <script src="../js/contactsdatatable.js"></script>
@endsection
