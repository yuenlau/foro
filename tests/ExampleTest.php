<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;

    public function testBasicExample()
    {
        $name = 'José Ramón Lea Otero';
        $email = 'jleasg3@psmsa.com';

        $user = factory(\App\User::class)->create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt('secret'),
        ]);

        $this->actingAs($user, 'api')
            ->visit('api/user')
            ->see($name)
            ->see($email);
    }
}
