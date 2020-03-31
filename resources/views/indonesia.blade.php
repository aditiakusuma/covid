<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Covid Indonesia</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-8" id="container">
                {{-- {{!! $chart->container() !!}} --}}
                <script src="https://code.highcharts.com/highcharts.js"></script>
                <script>
                    Highcharts.chart('container', {
                        chart: {
                            type: 'bar'
                        },
                        title: {
                            text: 'Data Covid-19 di Indonesia'
                        },
                        xAxis: {
                            categories: {!! json_encode($provinsi) !!}
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Total'
                            }
                        },
                        legend: {
                            reversed: true
                        },
                        plotOptions: {
                            series: {
                                stacking: 'normal'
                            }
                        },
                        series: [{
                            name: 'Positif',
                            data: {!!json_encode($positif)!!}
                        }, {
                            name: 'Meninggal',
                            data: {!!json_encode($meninggal)!!}
                        }, {
                            name: 'Sembuh',
                            data: {!!json_encode($sembuh)!!}
                        }]
                    });
                </script>
                {{-- {{!! $chart->script() !!}} --}}
            </div>
            <div class="col-4">
                <table class="table" id="covid">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Provinsi</th>
                            <th scope="col">Positif</th>
                            <th scope="col">Meninggal</th>
                            <th scope="col">Sembuh</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i=0;$i<$tot_pro;$i++) <tr>
                            <th align="left">{{$provinsi[$i]}}</th>
                            <td align="right">{{$positif[$i]}}</td>
                            <td align="right">{{$meninggal[$i]}}</td>
                            <td align="right">{{$sembuh[$i]}}</td>
                            </tr>
                            @endfor
                            <tr>
                                <th scope="row">TOTAL</th>
                                <td>{{$tot_pos}}</td>
                                <td>{{$tot_men}}</td>
                                <td>{{$tot_sem}}</td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>