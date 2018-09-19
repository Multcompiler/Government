
@extends('main')

@section('title', '| Home')

@section('content')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart()
        {
            var data = google.visualization.arrayToDataTable([
                ['Category', 'Number'],
                <?php
                foreach ($restoration as $value)
                {
                    echo "['".$value->school_name."', ".$value->total."],";
                }
                ?>
            ]);
            var options = {
                title: 'Total Requirements in each School',
                is3D:true,
                pieHole: 0.4
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>
    <div class="row">

        <div class="col-lg-4 col-sm-6 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total District</h3>
                <ul class="list-inline two-part">
                    <li>
                        <div id="sparklinedash3"></div>
                    </li>
                    <li class="text-right"><i class="ti-arrow-up text-info"></i> <span class="counter text-info">{{\App\District::all()->count()}}</span></li>
                </ul>
            </div>
        </div>

        <div class="col-lg-4 col-sm-6 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total Wards</h3>
                <ul class="list-inline two-part">
                    <li>
                        <div id="sparklinedash4"></div>
                    </li>
                    <li class="text-right"><i class="ti-arrow-up text-danger"></i> <span class="text-danger">{{\App\Ward::all()->count()}}</span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total Schools</h3>
                <ul class="list-inline two-part">
                    <li>
                        <div id="sparklinedash2"></div>
                    </li>
                    <li class="text-right"><i class="ti-arrow-up text-purple"></i> <span class="counter text-purple">{{\App\School::all()->count()}}</span></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box analytics-info text-center">
                <h2>Welcome to Government Requirement Collection for Secondary Schools</h2>
                <h2>District Officer</h2>
                <small>Management of school properties and staffs.</small>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box analytics-info text-center">
                <div class="row">
                    <div class="col-md-12">
                            <div id="piechart" style="width: 100%; height: 500px;"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection