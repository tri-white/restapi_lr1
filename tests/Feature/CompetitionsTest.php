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
         $response = $this->postJson('/api/competitions', ['name' => 'Sally']);
 
        // $response
        //     ->assertStatus(201)
        //     ->assertJson([
        //         'created' => true,
        //     ]);

            // try to post user with invalid fields
            //try to create record with fine fields
            
    }

    public function test_update(): void{
        // $response = $this->postJson('/api/user', ['name' => 'Sally']);
 
        // $response
        //     ->assertStatus(201)
        //     ->assertJson([
        //         'created' => true,
        //     ]);

            // try to edit unexisting record/
            // try to edit with invalid fields
            //  try to edit guarded fields
            // try to edit normal
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
