<?php

use App\Post;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostIntegrationTest extends TestCase
{

    use DatabaseTransactions;

    public function test_return_correct_url_post()
    {
        $user = $this->defaultUser();
        $post = factory(Post::class)->make();

        $user->posts()->save($post);

        $url_true = env('APP_URL') . "/posts/" . $post->id . "-" . $post->slug;
        $url = $post->url;

        $this->assertSame($url, $url_true);

    }

    public function test_a_slug_is_generated_and_saved_to_the_database()
    {
        $user = $this->defaultUser();
        $post = factory(Post::class)->make([
            'title' => 'Como instalar Laravel',
        ]);

        $user->posts()->save($post);

        $this->seeInDatabase('posts', [
            'slug' => 'como-instalar-laravel',
        ]);

        $this->assertSame(
            'como-instalar-laravel',
            $post->fresh()->slug
        );

        $this->assertSame('como-instalar-laravel', $post->slug);
    }
}
