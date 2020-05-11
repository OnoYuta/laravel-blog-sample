<?php

namespace Tests\Browser\Frontend;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Browser\Pages\Frontend\UserLoginPage;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserLoginTest extends DuskTestCase
{
    use DatabaseMigrations;
    use WithFaker;

    public function baseUrl()
    {
        return 'http://www.blog.sample:8000';
    }

    /**
     * user login
     *
     * @return void
     */
    public function testUserLogin()
    {
        $password = $this->faker->unique()->safeEmail;

        $user = factory(User::class)->create([
            'username'  => $this->faker->unique()->userName,
            'password'  => bcrypt($password),
        ]);

        $this->browse(function (Browser $browser) use ($user, $password) {
            $browser->visit(new UserLoginPage())
                ->type('@username', $user->username)
                ->type('@password', $password)
                ->press('@submit')
                ->assertRouteIs('home', []);
        });
    }

    /**
     * user logout
     *
     * @return void
     */
    public function testUserLogout()
    {
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit(route('home', [], false))
                ->click('#navbarDropdown')
                ->click('@logoutLink')
                ->assertSee(__('Login'));
        });
    }
}
