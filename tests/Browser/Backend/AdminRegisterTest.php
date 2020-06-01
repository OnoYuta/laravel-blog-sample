<?php

namespace Tests\Browser\Backend;

use App\Models\LaravelAdmin\Administrator;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Backend\AdminDashboard;
use Tests\Browser\Pages\Backend\AdminLoginPage;
use Tests\Browser\Pages\Backend\AdminUserSetting;
use Tests\DuskTestCase;

class AdminRegisterTest extends DuskTestCase
{
    use WithFaker;

    public function baseUrl()
    {
        return 'http://admin.blog.sample:8000';
    }

    /**
     * Admin Register
     *
     * @return void
     */
    public function testAdminRegister()
    {
        $newUsername = $this->faker->unique()->userName;
        while (Administrator::where('username', $newUsername)->exists()) {
            $newUsername = $this->faker->unique()->userName;
        }

        $this->assertDatabaseMissing('administrators', [
            'username' => $newUsername,
        ]);

        $this->browse(function (Browser $browser) use ($newUsername) {
            $browser->visit(new AdminLoginPage())
                ->press('@sampleLoginBtn')
                ->on(new AdminDashboard())
                ->visit('/administrators/create')
                ->type('#name', $this->faker->name)
                ->type('#username', $newUsername)
                ->type('#email', $this->faker->unique()->email)
                ->type('#password', $password = 'password')
                ->type('#password_confirmation', $password)
                ->press('button[type=submit].btn-primary')
                ->waitForText(__('admin.save_succeeded'));
        });

        $this->assertDatabaseHas('administrators', [
            'username' => $newUsername,
        ]);
    }

    /**
     * Admin Setting
     *
     * @return void
     */
    public function testAdminSetting()
    {
        $newName = $this->faker->name;
        while (Administrator::where('name', $newName)->exists()) {
            $newName = $this->faker->name;
        }

        $this->assertDatabaseMissing('administrators', [
            'name' => $newName,
        ]);

        $this->browse(function (Browser $browser) use ($newName) {
            $browser->visit(new AdminDashboard())
                ->press('@userMenuToggle')
                ->press('@userSettingBtn')
                ->waitForLocation(($adminUserSetting = new AdminUserSetting())->url())
                ->on($adminUserSetting)
                ->type('#name', $newName)
                ->type('#password', config('account.sample.admin.password'))
                ->type('#password_confirmation', config('account.sample.admin.password'))
                ->press('@submit')
                ->waitForText(__('admin.update_succeeded'));
        });

        $this->assertDatabaseHas('administrators', [
            'name' => $newName,
        ]);
    }
}
