<?php

namespace Database\Seeders;

use App\Models\NationalityCode;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http; 

class NationalityCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


        if(NationalityCode::exists()){
            return true;
        }

        $res=Http::get('http://country.io/iso3.json');

         $codes=$res->collect()->map(function($value,$key){
            return array(
                'name'=>$key
            );
         })->values()->toArray();

        NationalityCode::insert($codes);
    }
}
