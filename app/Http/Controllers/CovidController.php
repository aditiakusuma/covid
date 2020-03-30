<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//butuh use HTTP
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use App\Charts\IndonesiaProvinsiChart;

class CovidController extends Controller
{
    public function provinsi()
    {
        //fungsi flatten untuk menghilangkan atribut berdasarkan level
        $suspects       = Http::get('https://api.kawalcorona.com/indonesia/provinsi')->json();
        //$suspectData    = $suspects->flatten(1)->value()->All();
        //$suspectData = Arr::flatten($suspects,1);
        //dd($suspects);
        //melakukan pluk yaitu ambil data dengan label tertentu misal saja propinsi lihat json nya
        //pluk terbarubbisa mengambil langsung atribut di bawahnya satu level
        $provinsi   =Arr::pluck($suspects,'attributes.Provinsi');
        $positif    =Arr::pluck($suspects,'attributes.Kasus_Posi');
        $sembuh     =Arr::pluck($suspects,'attributes.Kasus_Semb');
        $meninggal  =Arr::pluck($suspects,'attributes.Kasus_Meni');
        //membuat chart
        $chart  = new IndonesiaProvinsiChart;
        $chart  ->labels($provinsi);
        $chart  ->dataset('Data Pasien Positif Corona di Indonesia', 'bar', $positif)
                ->options([
                    'color' => '#000000',
                    'backgroundColor' => 'yellow',
                ]);

        $chart2  = new IndonesiaProvinsiChart;
        $chart2  ->labels($provinsi);
        $chart2  ->dataset('Data Pasien Sembuh Corona di Indonesia', 'bar', $sembuh)
                ->options([
                    'color' => '#000000',
                    'backgroundColor' => 'green',
                ]);
        $chart3  = new IndonesiaProvinsiChart;
        $chart3  ->labels($provinsi);
        $chart3  ->dataset('Data Pasien Meninggal Corona di Indonesia', 'bar', $meninggal)
                ->options([
                    'color' => '#000000',
                    'backgroundColor' => 'red',
                ]);
        // dd($chart);
        return view('indonesia',compact(['chart','chart2','chart3']));
    }
}
