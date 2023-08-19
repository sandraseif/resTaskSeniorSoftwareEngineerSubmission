@extends('layouts.app')

@section('content')
    <div class="container">
        <form id="contact-form" method="post" action="{{ route('form') }}" role="form" enctype="multipart/form-data" >
        @csrf
            <div class="messages"></div>
            <div class="controls">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="form_name">Name *</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="form_name">Last Name *</label>
                            <input id="name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="form_name">Image *</label>
                            <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" required autocomplete="image" autofocus
                                   onchange="checkImage(this)">
                            <img id = "output" src="{{ asset('icons8-image-50.png')}}" alt="..." class="img-thumbnail">
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Submit') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
<script>
    function checkImage(input){
        var URL = window.URL || window.webkitURL;
        var file = input.files[0];

        if (file) {
            var image = new Image();
            image.onload = function() {
                if (this.width) {
                    document.getElementById('output').src = window.URL.createObjectURL(input.files[0])
                }
            };
            image.src = URL.createObjectURL(file);
        }

    }
</script>
