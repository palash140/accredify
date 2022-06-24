<?php

namespace Database\Seeders;

use App\Models\NationalityCode;
use App\Models\NationalityCodeMapping;
use Illuminate\Database\Seeder;

class DummyNationalityCodeMappingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if(NationalityCodeMapping::exists()){
            return true;
        }

        $randomLab=1;

        $mappings=NationalityCode::all()->map(function($code) use($randomLab){
            return  array(
                'user_id'=>$randomLab,
                'nationality_code_id'=>$code->id,
                'custom_nationality_code'=>$code->name.'P'
            );
        })->values()->toArray();

        NationalityCodeMapping::insert($mappings);

    }
}
