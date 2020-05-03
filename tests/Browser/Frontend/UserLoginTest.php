<?php

namespace Tests\Browser\Frontend;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Browser\Pages\Frontend\UserLoginPage;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserLoginTest extends DuskTestCase
{
    use WithFaker;

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testAdminCanLogin()
    {
        $password = $this->faker->unique()->safeEmail;

        $user = factory(User::class)->create([
            'username'  => $this->faker->unique()->userName,
            'password'  => bcrypt($password),
        ]);

        $this->browse(function (Browser $browser) use ($user, $password) {
            $browser->visit(new UserLoginPage)
                ->type('@username', $user->username)
                ->type('@password', $password)
                ->press('@submit')
                ->assertRouteIs('home', []);
        });
    }
}
