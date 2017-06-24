<?php

class ExampleTest extends FeatureTestCase
{
    function test_basic_example()
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
