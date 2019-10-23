<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        // test route
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testReplies()
    {
        // seed replies
        $this->seed('RepliesTableSeeder');

        // test threads
        $response = $this->get('/threads/1');
        $response->assertStatus(200);

        // test threads
        $response = $this->get('/threads/2');
        $response->assertStatus(200);

        // test threads
        $response = $this->get('/threads/a');
        $response->assertStatus(404);
    }

    public function testThreadVisualization()
    {
        // seed
        $this->seed('ThreadsTableSeeder');

        // test find
        $thread = \App\Thread::find(1);

        // test route id
        $response = $this->get('/threads/1');

        // test insert html title
        $response->assertSee($thread->title);

        // test insert html body
        $response->assertSee($thread->body);
    }
}
