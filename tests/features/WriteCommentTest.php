<?php

class WriteCommentTest extends FeatureTestCase
{
    function test_a_user_can_write_a_comment()
    {
        $user = $this->defaultUser();

        $post = $this->createPost();

        $this->actingAs($user)
            ->visit($post->url)
            ->seeInElement('h4', 'Comentarios')
            ->type('Un comentario', 'comment')
            ->press('Publicar comentario');

        $this->seeInDatabase('comments', [
            'comment' => 'Un comentario',
            'user_id' => $user->id
        ]);

        $this->seePageIs($post->url);
    }
}
