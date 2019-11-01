<?php

namespace Tests\Feature;

use App\Reply;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReplyTest extends TestCase
{
    // cria tabela
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testListagemDeRespostasPorTopico()
    {
        // cria user test
        $user = factory(\App\User::class)->create();

        // insert seed
        $this->seed('RepliesTableSeeder');

        $replies = \App\Reply::where('thread_id', 2)->get();

        $response = $this->actingAs($user)->json('GET', '/replies/2');

        $response->assertStatus(200)
            ->assertJson($replies->toArray());
    }

    public function testInclusaoDeNovaResposta()
    {
        // cria user test
        $user = factory(\App\User::class)->create();
        //cria thread
        $thread = factory(\App\Thread::class)->create();

        $response = $this->actingAs($user)
            ->json('POST', '/replies', [
                'body' => 'Novo Teste',
                'thread_id' => $thread->id
            ]);

        $reply = Reply::find(1);

        $response->assertStatus(200)
            ->assertJson($reply->toArray());
    }
}
