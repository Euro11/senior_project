@extends('frontend.inc.template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                  <button type="button" class="close" data-dismiss="alert">×</button> 
                  <strong>{{ $message }}</strong>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h2>สถิติการเข้าเรียน</h2>
                    </div>
                    @foreach($subject as $sub)
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3>{{ $sub->sub_name}}</h3>
                            </div>
                            @foreach($section as $sec)
                                @if($sec->subject_id == $sub->id)
                                    <a href="{{ route('statistic.show', $sec->id) }}">
                                        <p>Section {{ $sec->name}} : {{ $sec->day_name}} ( {{ $sec->class_date}} )</p>
                                    </a>                                  
                                @endif     
                            @endforeach
                        </div>
                    </div><br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection