@extends('frontend.inc.template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md">
            
            @foreach($subject as $sub)
            <div class="card">
                <div class="card-header"><b>{{ $sub->sub_name }}</b></div>
                <div class="card-body">                
                @foreach($section as $sec)
                    @if($sec->subject_id == $sub->id)
                    <a href="{{ route('viewsubject.showMember', [ $user->id, $sec->id]) }}"><p>Section {{ $sec->name}} : {{ $sec->day_name}} ( {{ $sec->class_date}} )</p></a>
                    @endif     
                @endforeach
                </div>
            </div><br>
            @endforeach 
        </div>
    </div>
</div>
@endsection