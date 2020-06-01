<?php

namespace Tests\Browser\Backend;

use AdministratorsTableSeeder;
use App\Models\Administrator;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Backend\AdminLoginPage;
use Tests\DuskTestCase;

class AdminLoginTest extends DuskTestCase
{
    use DatabaseMigrations;
    use WithFaker;

    public function baseUrl()
    {
        return 'http://admin.blog.sample:8000';
    }

    /**
     * admin login
     *
     * @return void
     */
    public function testAdminLogin()
    {
        $password = $this->faker->unique()->safeEmail;

        $admin = factory(Administrator::class)->create([
            'username'  => $this->faker->unique()->userName,
            'password'  => bcrypt($password),
        ]);

        $this->browse(function (Browser $browser) use ($admin, $password) {
            $browser->visit(new AdminLoginPage())
                ->type('@username', $admin->username)
                ->type('@password', $password)
                ->press('@submit')
                ->assertRouteIs('admin.home', []);
        });
    }

    /**
     * admin logout
     *
     * @return void
     */
    public function testAdminLogout()
    {
        $admin = factory(Administrator::class)->create();

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit(route('admin.home', [], false))
                ->click('.dropdown.user.user-menu')
                ->clickLink('ログアウト')
                ->waitForText(__('Login'))
                ->assertSee(__('Login'));
        });
    }

    /**
     * admin login as sample admin
     *
     * @return void
     */
    public function testAdminLoginAsSampleAdmin()
    {
        Schema::disableForeignKeyConstraints();
        $this->seed(AdministratorsTableSeeder::class);
        Schema::enableForeignKeyConstraints();

        $this->browse(function (Browser $browser) {
            $browser->visit(new AdminLoginPage())
                ->press('@sampleLoginBtn')
                ->assertRouteIs('admin.home', []);
        });
    }
}
