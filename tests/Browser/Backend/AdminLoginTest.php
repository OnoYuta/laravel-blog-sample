<?php

namespace Tests\Browser\Backend;

use App\Admin;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Models\Administrator;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Browser\Pages\Backend\AdminLoginPage;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminLoginTest extends DuskTestCase
{
    use DatabaseMigrations;
    use WithFaker;

    public function baseUrl()
    {
        return 'http://admin.blog.sample:8000';
    }

    /**
     * user login
     *
     * @return void
     */
    public function testAdminLogin()
    {
        $password = $this->faker->unique()->safeEmail;

        $user = factory(Administrator::class)->create([
            'username'  => $this->faker->unique()->userName,
            'password'  => bcrypt($password),
        ]);

        $this->browse(function (Browser $browser) use ($user, $password) {
            $browser->visit(new AdminLoginPage())
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
    public function testAdminLogout()
    {
        $user = factory(Administrator::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit(route('home', [], false))
                ->click('#navbarDropdown')
                ->click('@logoutLink')
                ->assertSee(__('Login'));
        });
    }
}
