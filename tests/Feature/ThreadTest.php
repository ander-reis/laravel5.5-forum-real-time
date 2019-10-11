<?php

namespace Tests\Feature;

use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
{
    // cria tabela
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testActionIndexOnController()
    {
        // cria user test
        $user = factory(\App\User::class)->create();

        // insert seed
        $this->seed('ThreadsTableSeeder');

        $threads = Thread::orderBy('updated_at', 'desc')->paginate();

        // test
        $response = $this
            // test user autenticado
            ->actingAs($user)
            // test api get
            ->json('GET', '/threads');

        // test se user está autenticado
        $response->assertStatus(200)
            // test return json
        ->assertJsonFragment([$threads->toArray()['data']]);
    }
}
