<?php

namespace App\Http\Requests\Patients;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkPatientStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules=[
            'patients'=>'required|array|max:100',
            'patients.*.patientNric'=>'required',
            'patients.*.patientName'=>'required',
            'patients.*.patientGender'=>['required','regex:/^(male|female)$/i'],
            'patients.*.patientBirthDate'=>'required|date_format:Y-m-d',
            'patients.*.patientEmail'=>'required|email',
            'patients.*.sampleUniqueId'=>'required',
            'patients.*.sampleResults'=>'required',
            'patients.*.collectedDateTime'=>'required|date_format:Y-m-d\TH:i:s\Z',
            'patients.*.effectiveDateTime'=>'required'
        ];

        if(!\Auth()->user()->nationalityCodeMappings()->exists()){ // if mapping not  provided  by lab
            $rules['patients.*.patientNationality']='required|exists:nationality_codes,name';
        }else{
            $rules['patients.*.patientNationality']='required';
        }


        return $rules;
    }



    public function validated($value=''){
        $input=parent::validated();
        if(!\Auth()->user()->nationalityCodeMappings()->exists()){ // if mapping not  provided  by lab
            return $input['patients'];
        }

        $defaultMapping='SG';

        $patients=collect($input['patients'])->map(function($patient)  use($defaultMapping){
            $mapping=auth()->user()->nationalityCodeMappings()->where('custom_nationality_code',$patient['patientNationality'])->first();
            if($mapping) {  // if  mapping  found
                $patient['patientNationality']=$mapping->nationalityCode->name;
            }else{
                $patient['patientNationality']=$defaultMapping;
            }
            return $patient; 
        })->values()->toArray();

        return $patients;
    }  
}
