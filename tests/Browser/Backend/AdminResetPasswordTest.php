<?php

namespace Tests\Browser\Frontend;

use App\Admin;
use App\Administrator;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Browser\Pages\Backend\AdminLoginPage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Pages\Backend\AdminForgotPasswordPage;

class AdminResetPasswordTest extends DuskTestCase
{
    use WithFaker;

    public function baseUrl()
    {
        return 'http://admin.blog.sample:8000';
    }

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testAdminSendPasswordResetLinkEmail()
    {
        $user = factory(Administrator::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit(new AdminLoginPage)
                ->clickLink(__('Forgot Your Password?'))
                ->on(new AdminForgotPasswordPage)
                ->type('@email', $user->email)
                ->press('@submit')
                ->assertSee(__(Password::RESET_LINK_SENT));
        });
    }
}
