@extends('dashboard-includes.app')

@section('title') RealEstateOne | Create article @endsection

@section('content')
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
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Title" value="{{ old('title') ? old('title') : '' }}">

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-primary font-weight-bold">Body</div>
                                    </div>
                                    <textarea rows="10" name="body" class="form-control @error('body') is-invalid @enderror" placeholder="Body">{{ old('body') ? old('body') : '' }}</textarea>

                                    @error('body')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-primary font-weight-bold">City</div>
                                    </div>
                                    <select name='city' class="form-control" id="exampleFormControlSelect1">
                                        <option value="Gjakove" {{ ( old("city") == 'Gjakove' ? "selected":"") }}>Gjakove</option>
                                        <option value="Prishtine" {{ ( old("city") == 'Prishtine' ? "selected":"") }}>Prishtine</option>
                                        <option value="Mitrovice" {{ ( old("city") == 'Mitrovice' ? "selected":"") }}>Mitrovice</option>
                                        <option value="Peje" {{ ( old("city") == 'Peje' ? "selected":"") }}>Peje</option>
                                        <option value="Prizren" {{ ( old("city") == 'Prizren' ? "selected":"") }}>Prizren</option>
                                        <option value="Gjilan" {{ ( old("city") == 'Gjilan' ? "selected":"") }}>Gjilan</option>
                                        <option value="Ferizaj" {{ ( old("city") == 'Ferizaj' ? "selected":"") }}>Ferizaj</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-primary font-weight-bold">Address</div>
                                    </div>
                                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="address" value="{{ old('address') ? old('address') : '' }}">

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-primary font-weight-bold">For</div>
                                    </div>
                                    <select name="for" class="form-control" id="exampleFormControlSelect1">
                                        <option value="both" {{ ( old("for") == 'both' ? "selected":"") }}>Both</option>
                                        <option value="sale" {{ ( old("for") == 'sale' ? "selected":"") }}>Sale</option>
                                        <option value="rent" {{ ( old("for") == 'rent' ? "selected":"") }}>Rent</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-primary font-weight-bold">Price</div>
                                    </div>
                                    <input name="price" type="number" class="form-control @error('price') is-invalid @enderror" placeholder="e.g. 200" value="{{ old('price') ? old('price') : '' }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">$</span>
                                    </div>

                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-primary font-weight-bold">Type</div>
                                    </div>
                                    <select name="type" class="form-control" id="exampleFormControlSelect1">
                                        <option value="1+1" {{ ( old("type") == '1+1' ? "selected":"") }}>1 + 1</option>
                                        <option value="2+1" {{ ( old("type") == '2+1' ? "selected":"") }}>2 + 1</option>
                                        <option value="3+1" {{ ( old("type") == '3+1' ? "selected":"") }}>3 + 1</option>
                                        <option value="3+2" {{ ( old("type") == '3+2' ? "selected":"") }}>3 + 2</option>
                                        <option value="4+1" {{ ( old("type") == '4+1' ? "selected":"") }}>4 + 1</option>
                                        <option value="4+2" {{ ( old("type") == '4+2' ? "selected":"") }}>4 + 2</option>
                                        <option value="5+1" {{ ( old("type") == '5+1' ? "selected":"") }}>5 + 1</option>
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
                                        <option value="0"  {{ ( old("available") == '0' ? "selected":"") }}>No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-primary font-weight-bold">Telephone</div>
                                    </div>
                                    <input name="phone_number" type="tel" class="form-control @error('phone_number') is-invalid @enderror" placeholder="Phone number" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" value="{{ old('phone_number') ? old('phone_number') : '' }}">

                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <input type="file" class="form-control @error('filenames') is-invalid @enderror" name="filenames[]" multiple="multiple">

                                    @error('filenames')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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


