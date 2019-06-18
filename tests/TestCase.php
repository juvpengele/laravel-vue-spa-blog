<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signIn(?User $user = null) : TestCase
    {
        $user = $user?: create(User::class);

        $this->actingAs($user);

        return $this;
    }
}
