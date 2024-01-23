<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use App\Models\Competitions;

class CompetitionsTest extends TestCase
{
    use RefreshDatabase;
    // test crud, and records in database

    /**
     * A basic feature test example.
     */
    public function test_index(){
        // test if route works
        $response = $this->get('/api/competitions');
 
        $response->assertStatus(200);

        //add record and test if its shown in response, if response gives 1 row.
        $competition = Competitions::factory()->create()->first();
        $response = $this->get('/api/competitions');
        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJson(fn (AssertableJson $json) =>
            $json->first(fn (AssertableJson $json)=>
                $json->where('id',$competition->id)->etc()
            )
        );
    }

    public function test_show(): void{
        $competition =  Competitions::factory()->create();
        $response = $this->get('/api/competitions/'.$competition->id);
    
        $response->assertStatus(200);// test also responseJson

        //test unexisting competitions
        $response = $this->get('/api/competitions/0');
 
        $response->assertStatus(404);

        
    }

    public function test_create(): void{
         $response = $this->postJson('/api/competitions',
          [
            'name'=>'Grand Prix',
            'event_date'=>now()->addDay(),
            'event_location'=>'Ukraine,Khmelnitsky',
            'prize_pool'=>5000,
            'sports_type'=>'100m sprint',
          ]
        );
 
         $response
             ->assertStatus(201)
             ->assertJson([
                 'name'=>'Grand Prix',
             ]);


             $response = $this->postJson('/api/competitions',
             [
               'name'=>'Grand Prix',
               'event_date'=>now()->addDay(),
               'event_location'=>'Ukraine,Khmelnitsky',
               'sports_type'=>'200m sprint',
             ]
           );
    
            $response
                ->assertStatus(422);

            
    }

    public function test_update(): void{
        $competition = Competitions::factory()->create();
        $response = $this->putJson('/api/competitions/'.$competition->id,
             [
               'name'=>'Grand Prix',
             ]
           );
           
    
            $response
                ->assertStatus(200);

                $response = $this->putJson('/api/competitions/0',
                     [
                       'name'=>'Grand Prix',
                     ]
                   );
                   
            
                    $response
                        ->assertStatus(404);

            //  try to edit guarded fields
            
            $response = $this->putJson('/api/competitions/0',
            [
              'updated_at'=>'Grand Prix',
            ]
          );
          
   
           $response
               ->assertStatus(404);
    }
    public function test_delete(): void{
        // $response = $this->postJson('/api/user', ['name' => 'Sally']);
 
        // $response
        //     ->assertStatus(201)
        //     ->assertJson([
        //         'created' => true,
        //     ]);

            // try to delete unexsiting record

            // try to delete existing record and check softDelete

            // try to forceDelete record and check that it doesnt exist in database
    }
}
