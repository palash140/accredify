<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NationalityCodeMapping extends Model
{
    use HasFactory;

    protected $fillable=['custom_nationality_code'];
    public $timestamps=false;
    

    public function nationalityCode(){
        return $this->belongsTo(NationalityCode::class,'nationality_code_id');
    }
}
