@extends('dashboard-includes.app')

@section('title') RealEstateOne | @can('admin') Admin @elsecan('user') User @endcan- Pannel  @endsection

@section('content')
    <div>
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">{{ __('pannel.dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            {{ __('pannel.you_logged') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection