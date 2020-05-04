<?php

namespace Tests\Browser\Frontend;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Browser\Pages\Frontend\UserLoginPage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Pages\Frontend\UserForgotPasswordPage;

class UserResetPasswordTest extends DuskTestCase
{
    use WithFaker;

    public function baseUrl()
    {
        return 'http://www.blog.sample:8000';
    }

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testUserSendPasswordResetLinkEmail()
    {
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit(new UserLoginPage())
                ->clickLink(__('Forgot Your Password?'))
                ->on(new UserForgotPasswordPage())
                ->type('@email', $user->email)
                ->press('@submit')
                ->assertSee(__(Password::RESET_LINK_SENT));
        });
    }
}
