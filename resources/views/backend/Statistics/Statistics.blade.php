@extends('backend.inc.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                  <button type="button" class="close" data-dismiss="alert">×</button> 
                  <strong>{{ $message }}</strong>
                </div>
            @endif
            @if ($message = Session::get('warning'))
                <div class="alert alert-warning alert-block">
                  <button type="button" class="close" data-dismiss="alert">×</button> 
                  <strong>{{ $message }}</strong>
                </div>
            @endif
            @if ($message = Session::get('delete'))
                <div class="alert alert-danger alert-block">
                  <button type="button" class="close" data-dismiss="alert">×</button> 
                  <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Statistics</h3>
                    </div>
                </div>
            </div><br>
            @foreach($subject as $sub)
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>{{ $sub->sub_name}}</h3>
                    </div>
                    @foreach($section as $sec)
                        @if($sec->subject_id == $sub->id)
                            @if(Auth::user()->id == $sec->teacher_id)
                                <a href="{{ route('ViewStatistics.show', $sec->id) }}"><p>Section {{ $sec->name}} : {{ $sec->day_name}} ( {{ $sec->class_date}} )</p></a>
                            @else
                                <p>Section {{ $sec->name}} : {{ $sec->day_name}} ( {{ $sec->class_date}} )</p>
                            @endif     
                        @endif     
                    @endforeach
                </div>
            </div><br>
            @endforeach
        </div>
    </div>
</div>
@endsection