<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Sportsmen;
use Illuminate\Testing\Fluent\AssertableJson;


class SportsmenTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_index(){
        // test if route works
        $response = $this->get('/api/sportsmen');
 
        $response->assertStatus(200);

        //add record and test if its shown in response, if response gives 1 row.
        $sportsmen = Sportsmen::factory()->create()->first();
        $response = $this->get('/api/sportsmen');
        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJson(fn (AssertableJson $json) =>
            $json->first(fn (AssertableJson $json)=>
                $json->where('id',$sportsmen->id)->etc()
            )
        );
    }

    public function test_show(): void{
        $sportsmen =  Sportsmen::factory()->create();
        $response = $this->get('/api/sportsmen/'.$sportsmen->id);
    
        $response->assertStatus(200);// test also responseJson

        //test unexisting sportsmen
        $response = $this->get('/api/sportsmen/0');
 
        $response->assertStatus(404);

        
    }

    public function test_create(): void{
         $response = $this->postJson('/api/sportsmen',
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
                 'name'=>'Grand Prix',
             ]);


             $response = $this->postJson('/api/sportsmen',
             [
               'name'=>'Grand Prix',
               'email'=>'hi',
             ]
           );
    
            $response
                ->assertStatus(422);

            
    }

    public function test_update(): void{
        $sportsmen = Sportsmen::factory()->create();
        $response = $this->putJson('/api/sportsmen/'.$sportsmen->id,
             [
               'name'=>'Grand',
             ]
           );
           
    
            $response
                ->assertStatus(200);

                $response = $this->putJson('/api/sportsmen/0',
                     [
                       'name'=>'Grand',
                     ]
                   );
                   
            
                    $response
                        ->assertStatus(404);

            //  try to edit guarded fields
            
            $response = $this->putJson('/api/sportsmen/1',
            [
              'updated_at'=>'Grand Prix',
            ]
          );
          
   
           $response
               ->assertStatus(404);
    }
    public function test_delete(): void{
        $sportsmen=Sportsmen::factory()->create();
           $response =  $this->deleteJson('api/sportsmen/'.$sportsmen->id);
         $response
             ->assertStatus(200)
             ->assertJson([
                 'message'=>'deleted',
             ]);
             $this->assertDatabaseEmpty('sportsmen');

            // try to delete unexsiting record
            $response =  $this->deleteJson('api/sportsmen/0');
          $response
              ->assertStatus(404);
    }
}
