<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Regulations;
use Illuminate\Testing\Fluent\AssertableJson;

class RegulationsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_index(){
        // test if route works
        $response = $this->get('/api/regulations');
 
        $response->assertStatus(200);

        //add record and test if its shown in response, if response gives 1 row.
        $regulation = Regulations::factory()->create()->first();
        $response = $this->get('/api/regulations');
        $response->assertStatus(200)
              ->assertJson([
                'data'=>[
                  [
                    'id'=>$regulation->id,
                  ]
                ]
              ]
          );
    }

    public function test_show(): void{
        $regulation =  Regulations::factory()->create();
        $response = $this->get('/api/regulations/'.$regulation->id);
    
        $response->assertStatus(200);// test also responseJson

        //test unexisting regulations
        $response = $this->get('/api/regulations/0');
 
        $response->assertStatus(404);

        
    }

    public function test_create(): void{
         $response = $this->postJson('/api/regulations',
          [
            'name'=>'100m run',
            'description'=>"100m sprint on rubber surface",
            'minimal_requirements'=>'run 100m in under 11.3s',
            'gender'=>"male",
          ]
        );
 
         $response
             ->assertStatus(201)
             ->assertJson([
              'data'=>[
                'name'=>'100m run',

              ]
             ]);


             $response = $this->postJson('/api/regulations',
             [
                'name'=>'100m run',
                'description'=>"100m sprint on rubber surface",
                'gender'=>"me",
             ]
           );
    
            $response
                ->assertStatus(422);

            
    }

    public function test_update(): void{
        $regulation = Regulations::factory()->create();
        $response = $this->putJson('/api/regulations/'.$regulation->id,
             [
               'name'=>'100m run',
             ]
           );
           
    
            $response
                ->assertStatus(200);

                $response = $this->putJson('/api/regulations/0',
                     [
                       'name'=>'tester',
                     ]
                   );
                   
            
                    $response
                        ->assertStatus(404);

            //  try to edit guarded fields
            
            $response = $this->putJson('/api/regulations/1',
            [
              'updated_at'=>now(),
            ]
          );
          
   
           $response
               ->assertStatus(404);
    }
    public function test_delete(): void{
        $regulation=Regulations::factory()->create();
           $response =  $this->deleteJson('api/regulations/'.$regulation->id);
         $response
             ->assertStatus(200)
             ->assertJson([
                 'message'=>'deleted',
             ]);
             $this->assertDatabaseEmpty('regulations');

            // try to delete unexsiting record
            $response =  $this->deleteJson('api/regulations/0');
          $response
              ->assertStatus(404);
    }
}
