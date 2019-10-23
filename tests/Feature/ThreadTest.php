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

    public function testActionStoreOnController()
    {
        // cria user test
        $user = factory(\App\User::class)->create();

        // test
        $response = $this
            // test user autenticado
            ->actingAs($user)
            // test api get
            ->json('POST', '/threads', ['title' => 'Meu primeiro tópico', 'body' => 'exemplo de tópico']);

        // select thread
        $thread = Thread::find(1);

        // test se user está autenticado
        $response->assertStatus(200)
            // test return json
            ->assertJsonFragment(['created' => 'success'])
            ->assertJsonFragment([$thread->toArray()]);
    }

    public function testActionUpdateOnController()
    {
        // cria user test
        $user = factory(\App\User::class)->create();
        $thread = factory(\App\Thread::class)->create([
            'user_id' => $user->id
        ]);

        // test
        $response = $this
            // test user autenticado
            ->actingAs($user)
            // test api get
            ->json('PUT', '/threads/' . $thread->id, ['title' => 'Meu primeiro tópico alterado', 'body' => 'exemplo de tópico alterado']);

        // verifica thread
        $thread->title = 'Meu primeiro tópico alterado';
        $thread->body = 'exemplo de tópico alterado';

        // test se user está autenticado
        $response->assertStatus(302);
            // test return json
        $this->assertEquals(Thread::find(1)->toArray(), $thread->toArray());
    }
}
