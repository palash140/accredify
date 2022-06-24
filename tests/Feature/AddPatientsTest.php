<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;

class AddPatientsTest extends TestCase
{
   
    public function test_require_patients_array(){
        Sanctum::actingAs(User::first());
        $response=$this->json('POST', 'api/patients/bulk');
        $response->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "patients" => ["The patients field is required."]
                ]
            ]);
    }



    public function test_patients_required_fields(){
         Sanctum::actingAs(User::first());
         $input=[
            'patients'=>[
                    []
                ]
         ];
        $response=$this->json('POST', 'api/patients/bulk',$input);
        $response->assertStatus(422)
        ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "patients.0.patientNric" => ["The patients.0.patientNric field is required."]
                ]
            ]);

    }



    public function test_patients_valid_email(){
         Sanctum::actingAs(User::first());
         $input=[
            'patients'=>[
                    [
                        "patientEmail"=>"temp"
                    ]
                ]
         ];
        $response=$this->json('POST', 'api/patients/bulk',$input);
        $response->assertStatus(422)
        ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "patients.0.patientEmail" => ["The patients.0.patientEmail must be a valid email address."]
                ]
            ]);

    }


    public function test_valid_patient_gender(){

        Sanctum::actingAs(User::first());
         $input=[
            'patients'=>[
                    [
                        "patientGender"=>"temp"
                    ]
                ]
         ];
        $response=$this->json('POST', 'api/patients/bulk',$input);
        $response->assertStatus(422)
        ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "patients.0.patientGender" => ["The patients.0.patientGender format is invalid."]
                ]
            ]);
    }



    public function test_valid_patients_details(){

        Sanctum::actingAs(User::first());
         $input=[
            'patients'=>[
                    [
                        "patientNationality"=>"SG",
                        "patientNric"=> "S0000000A",
                        "patientName"=> "Tan Chen Chen",
                        "patientGender"=> "Female",
                        "patientBirthDate"=> "1990-01-15",
                        "patientEmail"=> "tanchenchen@gmail.com",
                        "sampleUniqueId"=> "Sample001",
                        "sampleResults"=> "Negative",
                        "collectedDateTime"=> "2021-02-01T12:00:00Z",
                        "effectiveDateTime"=> "2021-02-01T12:00:00Z"                        
                    ]
                ]
         ];
        $response=$this->json('POST', 'api/patients/bulk',$input);
        $response->assertStatus(200)
        ->assertJson([
                "message" => "Patients Created successfully"
            ]);
    }



    



}
