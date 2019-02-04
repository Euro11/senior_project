@extends('backend.inc.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Dashboard</h3>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="alert alert-success" role="alert">
                        @if(Auth::user()->role == 3)
                            <p>You are logged in! as ADMINISTRATOR</p>
                        @else
                            <p>You are logged in! as TEACHER</p>
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection