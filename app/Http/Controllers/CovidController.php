<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//butuh use HTTP
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use App\Charts\IndonesiaProvinsiChart;

class CovidController extends Controller
{
    public function provinsi()
    {
        //fungsi flatten untuk menghilangkan atribut berdasarkan level
        $suspects       = Http::get('https://api.kawalcorona.com/indonesia/provinsi')->json();
        //$suspectData    = $suspects->flatten(1)->value()->All();
        // $suspectData = Arr::pluck($suspects,'attributes');
        // $suspectData1 = Arr::except($suspectData,'FID');
        // dd($suspectData1);
        //melakukan pluk yaitu ambil data dengan label tertentu misal saja propinsi lihat json nya
        //pluk terbarubbisa mengambil langsung atribut di bawahnya satu level
        $provinsi   =Arr::pluck($suspects,'attributes.Provinsi');
        $tot_pro    =collect($provinsi)->count();
        $positif    =Arr::pluck($suspects,'attributes.Kasus_Posi');
        $tot_pos    =collect($positif)->sum();
        $sembuh     =Arr::pluck($suspects,'attributes.Kasus_Semb');
        $tot_sem    =collect($sembuh)->sum();
        $meninggal  =Arr::pluck($suspects,'attributes.Kasus_Meni');
        $tot_men    =collect($meninggal)->sum();

        //dd($data);
        
        //membuat chart
        // $chart  = new IndonesiaProvinsiChart;
        // $chart  ->labels($label);
        // $chart  ->dataset('Data Pasien Positif Corona di Indonesia', 'bar', $data);
        return view('indonesia',compact([
            'provinsi',
            'positif',
            'sembuh',
            'meninggal',
            'tot_pro',
            'tot_sem',
            'tot_pos',
            'tot_men'
            ]));
    }
}
