@extends('layouts.app')

@section('content')
    <div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Contact-us</div>
                    <div class="container">
                        <div class="card-body">
                            <table class="table table-bordered" id="contactsus-table">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Created At</th>
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

@section('data')
    <script>
        $(function() {
            $('#contactsus-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/admin/data/contactsus',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'subject', name: 'subject' },
                    { data: 'created_at', name: 'created_at' },
                ]
            });
        });
    </script>
@endsection
