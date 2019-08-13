@extends('layouts.app')

@section('title') RealEstateOne | Admin-ContactUs @endsection

@section('content')
    <div>
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">Contact from {{ $contact->name }}</div>
                    <div class="container">
                        <div class="card-body">
                            {{ $contact->message }}
                        </div>
                    </div>
                    <div class="card-footer">
                        {{ $contact->created_at }}
                    </div>
                </div>
                <a class="btn btn-secondary mt-2" href="{{ route('admin.contactus') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>
        </div>
    </div>
@endsection
