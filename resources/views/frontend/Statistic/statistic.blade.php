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
                    <div class="form-group row">
                        <div class="col-md-12 text-center">
                            <h3>ราดละเอียดวิชา</h3>
                            <p><b>ชื่อวิชา : </b>Numerical Method</p>
                            <p><b>รหัสวิชา : </b>12345678</p>
                            <p>รูปอาจารย์</p>
                            <p><b>อาจารย์ : </b>ปองพล พิจารวาณิช</p>
                        </div>   
                        <div class="col-md-12 text-center">
                            <table id="datatables" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="5">No.</th>
                                        <th>Member</th>
                                        <th>E-mail</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
    <script type="text/javascript" src="{{ asset('js/backend/DataTables/datatables.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#datatables').DataTable();
        } );
    </script>
@endsection