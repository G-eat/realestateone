@extends('layouts.app')

@section('content')
    <ul>

        @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>
    <div>
        <div class="row justify-content-center">
            <div class="col-11 pb-5">
                <form action="{{ route(('article.store')) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card border-primary rounded-0">
                        <div class="card-header p-0">
                            <div class="bg-info text-white text-center py-2">
                                <h3>Create Article</h3>
                            </div>
                        </div>
                        <div class="card-body p-3">

                            <!--Body-->
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-primary font-weight-bold">Title</div>
                                    </div>
                                    <input type="text" name="title" class="form-control" placeholder="Title" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-primary font-weight-bold">Body</div>
                                    </div>
                                    <textarea rows="10" name="body" class="form-control" placeholder="Body" required></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-primary font-weight-bold">City</div>
                                    </div>
                                    <select name='city' class="form-control" id="exampleFormControlSelect1">
                                        <option value="Gjakove">Gjakove</option>
                                        <option value="Prishtine">Prishtine</option>
                                        <option value="Mitrovice">Mitrovice</option>
                                        <option value="Peje">Peje</option>
                                        <option value="Prizren">Prizren</option>
                                        <option value="Gjilan">Gjilan</option>
                                        <option value="Ferizaj">Ferizaj</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-primary font-weight-bold">Address</div>
                                    </div>
                                    <input type="text" name="address" class="form-control" placeholder="address" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-primary font-weight-bold">For</div>
                                    </div>
                                    <select name="for" class="form-control" id="exampleFormControlSelect1">
                                        <option value="both">Both</option>
                                        <option value="sale">Sale</option>
                                        <option value="rent">Rent</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-primary font-weight-bold">Price</div>
                                    </div>
                                    <input name="price" type="number" class="form-control" placeholder="e.g. 200"  required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">$</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-primary font-weight-bold">Type</div>
                                    </div>
                                    <select name="type" class="form-control" id="exampleFormControlSelect1">
                                        <option value="1+1">1 + 1</option>
                                        <option value="2+1">2 + 1</option>
                                        <option value="3+1">3 + 1</option>
                                        <option value="3+2">3 + 2</option>
                                        <option value="4+1">4 + 1</option>
                                        <option value="4+2">4 + 2</option>
                                        <option value="5+1">5 + 1</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-primary font-weight-bold">Available</div>
                                    </div>
                                    <select name="available" class="form-control" id="exampleFormControlSelect1">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-primary font-weight-bold">Telephone</div>
                                    </div>
                                    <input name="phone_number" type="tel" class="form-control" placeholder="Phone number" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <input type="file" class="form-control" name="filenames[]" multiple="multiple">
                                </div>
                            </div>

                            <div class="text-center">
                                <input type="submit" value="Create" class="btn btn-info btn-block rounded-0 py-2">
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


