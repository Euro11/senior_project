@extends('backend.inc.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Create Subject</h3>
                    </div>
                    <form method="POST" action="{{ route('managesubject.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('Subject ID') }}</label>

                            <div class="col-md-6">
                                <input id="id" type="text" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id">

                                @if ($errors->has('id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sub_name" class="col-md-4 col-form-label text-md-right">{{ __('Subject Name') }}</label>

                            <div class="col-md-6">
                                <input id="sub_name" type="text" class="form-control{{ $errors->has('sub_name') ? ' is-invalid' : '' }}" name="sub_name" required autofocus>

                                @if ($errors->has('sub_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sub_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sub_unit" class="col-md-4 col-form-label text-md-right">{{ __('Unit') }}</label>

                            <div class="col-md-6">
                                <select id="sub_unit" class="select2-multi form-control" name="sub_unit">
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="6">6</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sub_description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea name="sub_description" id="editor"></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                                <a href="{{ URL::previous() }}" class="btn btn-outline-primary">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<!-- ckeditor -->
<script src="{{asset('templateEditor/ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace( 'editor' )
</script>
@endsection