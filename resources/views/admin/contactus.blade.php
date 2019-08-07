@extends('layouts.app')

@section('content')
    <div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Contact-us</div>

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach( $contacts as $contact)
                                <li class="list-group-item">{{ $contact->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
