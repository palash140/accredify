<?php

namespace App\Http\Controllers;

use App\Http\Requests\Patients\BulkPatientStoreRequest;
use Illuminate\Http\Request;

class PatientsController extends Controller{


    public function bulkStore(BulkPatientStoreRequest $request){
        $paitentsRequestBody=$request->validated();
        // store  patients
        return response([
            'message'=>'Patients Created successfully'
        ]);
    }
}


