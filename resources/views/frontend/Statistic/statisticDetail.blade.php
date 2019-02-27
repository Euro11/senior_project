@extends('frontend.inc.template')

@section('content')
<style>
    #container1 {
        max-width: 800px;
        height: 115px;
        margin: 1em auto;
    }
</style>
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
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                @foreach($section as $s)
                                <h3><a href="{{ url('/statistic')}}"><button class="btn btn-light"><i class="fas fa-arrow-left"></i></button></a>
                                สถิติวิชา {{ $s->sub_name }} : Section {{ $s->name}} {{ $s->day_name}} ( {{ $s->class_date}} )</h3>
                                @endforeach
                            </div>
                            <div id="container1"></div>
                            <div class="text-center">
                            @if($score >= 12)
                                <span style="color: #00bca1"><i class="fas fa-check-circle fa-7x"></i></span>
                            @else
                                <span style="color: #fe5a59"><i class="fas fa-times fa-7x"></i></span>
                            @endif
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/bullet.js"></script>
<script>
Highcharts.setOptions({
    chart: {
        inverted: true,
        type: 'bullet'
    },
    title: {
        text: null
    },
    legend: {
        enabled: false
    },
    yAxis: {
        gridLineWidth: 0
    },
    plotOptions: {
        series: {
            pointPadding: 0.25,
            borderWidth: 0,
            color: 'rgba(255, 255, 255, 0.8)',
            targetOptions: {
                width: '200%'
            }
        }
    },
    credits: {
        enabled: false
    },
    exporting: {
        enabled: false
    }
});

Highcharts.chart('container1', {
    chart: {
        marginTop: 0
    },
    title: {
        text: '<b>จำนวนครั้งที่เข้าเรียน</b>'
    },
    xAxis: {
        categories: ['']
    },
    yAxis: {
        plotBands: [{
            from: 0,
            to: 12,
            color: '#fe5a59'
        }, {
            from: 12,
            to: 15,
            color: '#00bca1'
        }],
        title: 'null'
    },
    series: [{
        data: [{
            y: {{ $score }},
            target: 12
        }]
    }],
});
</script>
@endsection