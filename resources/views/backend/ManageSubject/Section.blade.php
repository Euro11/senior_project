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
                        <h3><a href="{{ url('/managesubject')}}">Manage Subject</a> > Section</h3>
                    </div>
                    <div class="text-right">
                        <a href="{{ route('section.CreateSection', $subject->id)}}"> 
                            <button type="button" class="btn btn-primary"><i class="fa fa-plus-circle"></i> New Section</button>
                        </a>
                    </div>
                    <table id="datatables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>section</th>
                                <th>อาจารย์ผู้สอน</th>
                                <th width="10%">ปีการศึกษา</th>
                                <th width="5%">จำนวนผู้เรียน</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($section as $s)
                                <tr>
                                    <td>{{ $s->name }} ({{ $s->day_name }} : {{ $s->class_date }})</td>
                                    <td>{{ $s->teacher_name }}</td>
                                    <td>{{ $s->year }}</td>
                                    <td  class="text-center">
                                        {{ $s->std_count }}
                                        <a href="{{ route('section.show', $s->id)}}"> 
                                            <button type="submit" class="btn btn-info"><i class="fas fa-user-plus"></i></button>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="form-group d-flex justify-content-around">
                                            
                                            <a href="{{ route('section.edit', $s->id)}}"> 
                                                <button type="submit" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></button>
                                            </a>

                                            <form action="{{ route('section.destroy', $s->id)}}" method="POST">
                                                {!! method_field('DELETE') !!}
                                                @csrf
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i> </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection