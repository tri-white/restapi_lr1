<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Sportsmans;
use Illuminate\Testing\Fluent\AssertableJson;


class SportsmansTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_index(){
        // test if route works
        $response = $this->get('/api/sportsmans');
 
        $response->assertStatus(200);

        //add record and test if its shown in response, if response gives 1 row.
        $sportsmans = Sportsmans::factory()->create()->first();
        $response = $this->get('/api/sportsmans');
        $response->assertStatus(200)
            ->assertJson([
              'data'=>[
                [
                  'id'=>$sportsmans->id,
                ]
              ]
            ]
        );
    }

    public function test_show(): void{
        $sportsmans =  Sportsmans::factory()->create();
        $response = $this->get('/api/sportsmans/'.$sportsmans->id);
    
        $response->assertStatus(200);// test also responseJson

        //test unexisting sportsmans
        $response = $this->get('/api/sportsmans/0');
 
        $response->assertStatus(404);

        
    }

    public function test_create(): void{
         $response = $this->postJson('/api/sportsmans',
          [
            'name'=>'Grand Prix',
            'gender'=>'male',
            'category'=>'tennis',
            'sponsor'=>'Omega Inc',
          ]
        );
 
         $response
             ->assertStatus(201)
             ->assertJson([
              'data'=>[
                'name'=>'Grand Prix',

              ]
             ]);


             $response = $this->postJson('/api/sportsmans',
             [
               'name'=>'Grand Prix',
               'email'=>'hi',
             ]
           );
    
            $response
                ->assertStatus(422);

            
    }

    public function test_update(): void{
        $sportsmans = Sportsmans::factory()->create();
        $response = $this->putJson('/api/sportsmans/'.$sportsmans->id,
             [
               'name'=>'Grand',
             ]
           );
           
    
            $response
                ->assertStatus(200);

                $response = $this->putJson('/api/sportsmans/0',
                     [
                       'name'=>'Grand',
                     ]
                   );
                   
            
                    $response
                        ->assertStatus(404);

            //  try to edit guarded fields
            
            $response = $this->putJson('/api/sportsmans/1',
            [
              'updated_at'=>'Grand Prix',
            ]
          );
          
   
           $response
               ->assertStatus(404);
    }
    public function test_delete(): void {
        $sportsmans=Sportsmans::factory()->create();
           $response =  $this->deleteJson('api/sportsmans/'.$sportsmans->id);
         $response
             ->assertStatus(200)
             ->assertJson([
                 'message'=>'deleted',
             ]);
             $this->assertDatabaseEmpty('sportsmans');

            // try to delete unexsiting record
            $response =  $this->deleteJson('api/sportsmans/0');
          $response
              ->assertStatus(404);
    }
}
