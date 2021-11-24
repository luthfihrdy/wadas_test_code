@extends('nav')
@section('content')
    <h1>Test Coding PT Wahana Datarindo Sempurna</h1>
    <hr class="m-1">
    <br/>
    <h3>Chart per hari</h3>
    <br/>
    <div class="container">
        <div class="row">

            <div id="graph">

            </div>

        </div>

        

    <!-- penambahan cdn + script setting buat graph -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>  
    <!-- optional -->  
    <script src="https://code.highcharts.com/modules/offline-exporting.js"></script>  
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    
    <script>

        Highcharts.chart('graph', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Transaksi per hari'
        },
        subtitle: {
            text: 'Source: luthfi'
        },
        xAxis: {
            categories: {!!json_encode($day)!!},
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total Per Hari'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Day',
            data: [<?php echo join($totalDay, ',') ?>]
    
        }]
    });
    </script>

    
    
    
@endsection
