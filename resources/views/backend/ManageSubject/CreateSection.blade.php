@extends('backend.inc.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Create Section</h3>
                    </div>
                    <form method="POST" action="{{ route('section.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Section Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="year" class="col-md-4 col-form-label text-md-right">{{ __('ปีการศึกษา') }}</label>

                            <div class="col-md-6">
                                <input id="year" type="text" class="form-control" name="year" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="class_date" class="col-md-4 col-form-label text-md-right">{{ __('เวลาเรียน') }}</label>

                            <div class="col-md-6">
                                <input id="class_date" type="text" class="form-control" name="class_date" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="class_day" class="col-md-4 col-form-label text-md-right">{{ __('วันที่เรียน') }}</label>

                            <div class="col-md-6">                                   
                                <select id="class_day" class="select2-multi form-control" name="class_day">
                                  <option value="1">1 : อาทิตย์</option>
                                  <option value="2">2 : จันทร์</option>
                                  <option value="3">3 : อังคาร</option>
                                  <option value="4">4 : พุธ</option>
                                  <option value="5">5 : พฤหัสบดี</option>
                                  <option value="6">6 : ศุกร์</option>
                                  <option value="7">7 : เสาร์</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="subject_id" class="col-md-4 col-form-label text-md-right">{{ __('Subject ID') }}</label>

                            <div class="col-md-6">
                                <input id="subject_id" type="text" class="form-control{{ $errors->has('subject_id') ? ' is-invalid' : '' }}" value="{{ $subject->id }}" name="subject_id">
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
<script src="{{ asset('js/backend/inputmask.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#class_date').mask('99:99 - 99:99');
    });
</script>
@endsection