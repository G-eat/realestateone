@extends('admin-includes.app')

@section('title') RealEstateOne | Admin-Update article @endsection

@section('content')
    <div>
        <div class="row justify-content-center">
            <div class="col-11 pb-5">
                <form action="{{ route('article.update', $article->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card border-primary rounded-0">
                        <div class="card-header p-0">
                            <div class="bg-info text-white text-center py-2">
                                <h3>{{ $article->title }}</h3>
                            </div>
                        </div>
                        <div class="card-body p-3">

                            <!--Body-->
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-primary font-weight-bold">Title</div>
                                    </div>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Title" value="{{ old('title') ? old('title') : $article->title }}">

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
                                    <textarea rows="10" name="body" class="form-control @error('body') is-invalid @enderror" placeholder="Body">{{ old('body') ? old('body') : $article->body }}</textarea>

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
                                        <option value="Gjakove" {{ ( old("city") == 'Gjakove' ? "selected": ($article->city) == 'Gjakove' ? 'selected' : "") }}>Gjakove</option>
                                        <option value="Prishtine" {{ ( old("city") == 'Prishtine' ? "selected": ($article->city) == 'Prishtine' ? 'selected' : "") }}>Prishtine</option>
                                        <option value="Mitrovice" {{ ( old("city") == 'Mitrovice' ? "selected": ($article->city) == 'Mitrovice' ? 'selected' : "") }}>Mitrovice</option>
                                        <option value="Peje" {{ ( old("city") == 'Peje' ? "selected": ($article->city) == 'Peje' ? 'selected' : "") }}>Peje</option>
                                        <option value="Prizren" {{ ( old("city") == 'Prizren' ? "selected": ($article->city) == 'Prizren' ? 'selected' : "") }}>Prizren</option>
                                        <option value="Gjilan" {{ ( old("city") == 'Gjilan' ? "selected": ($article->city) == 'Gjilan' ? 'selected' : "") }}>Gjilan</option>
                                        <option value="Ferizaj" {{ ( old("city") == 'Ferizaj' ? "selected": ($article->city) == 'Ferizaj' ? 'selected' : "") }}>Ferizaj</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-primary font-weight-bold">Address</div>
                                    </div>
                                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="address" value="{{ old('address') ? old('address') : $article->address }}">

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
                                        <option value="sale" {{ ( old("for") == 'sale' ? "selected": ($article->for) == 'sale' ? 'selected' : "") }}>Sale</option>
                                        <option value="rent" {{ ( old("for") == 'rent' ? "selected": ($article->for) == 'rent' ? 'selected' : "") }}>Rent</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-primary font-weight-bold">Price</div>
                                    </div>
                                    <input name="price" type="number" class="form-control @error('price') is-invalid @enderror" placeholder="e.g. 200" value="{{ old('price') ? old('price') : $article->price }}">
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
                                        <option value="1+1" {{ ( old("type") == '1+1' ? "selected": ($article->type) == '1+1' ? 'selected' : "") }}>1 + 1</option>
                                        <option value="2+1" {{ ( old("type") == '2+1' ? "selected": ($article->type) == '2+1' ? 'selected' : "") }}>2 + 1</option>
                                        <option value="3+1" {{ ( old("type") == '3+1' ? "selected": ($article->type) == '3+1' ? 'selected' : "") }}>3 + 1</option>
                                        <option value="3+2" {{ ( old("type") == '3+2' ? "selected": ($article->type) == '3+2' ? 'selected' : "") }}>3 + 2</option>
                                        <option value="4+1" {{ ( old("type") == '4+1' ? "selected": ($article->type) == '4+1' ? 'selected' : "") }}>4 + 1</option>
                                        <option value="4+2" {{ ( old("type") == '4+2' ? "selected": ($article->type) == '4+2' ? 'selected' : "") }}>4 + 2</option>
                                        <option value="5+1" {{ ( old("type") == '5+1' ? "selected": ($article->type) == '5+1' ? 'selected' : "") }}>5 + 1</option>
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
                                        <option value="0"  {{ ( old("available") == '0' ? "selected": ($article->available) == '0' ? 'selected' : "") }}>No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-primary font-weight-bold">Telephone</div>
                                    </div>
                                    <input name="phonenumber" type="tel" class="form-control @error('phonenumber') is-invalid @enderror" placeholder="Phone number" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" value="{{ old('phone_number') ? old('phone_number') : $article->phonenumber }}">

                                    @error('phonenumber')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-primary font-weight-bold">Upload photos</div>
                                    </div>
                                    <input type="file" class="form-control @error('filenames') is-invalid @enderror" name="filenames[]" multiple="multiple">

                                    @error('filenames')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-center">
                                <input type="submit" value="Update" class="btn btn-info btn-block rounded-0 py-2">
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


