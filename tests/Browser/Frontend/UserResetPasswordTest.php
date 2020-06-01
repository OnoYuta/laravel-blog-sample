<?php

namespace Tests\Browser\Frontend;

use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Frontend\UserForgotPasswordPage;
use Tests\Browser\Pages\Frontend\UserLoginPage;
use Tests\DuskTestCase;

class UserResetPasswordTest extends DuskTestCase
{
    use SendsPasswordResetEmails;
    use WithFaker;

    public function baseUrl()
    {
        return 'http://www.blog.sample:8000';
    }

    /**
     * Test emailing user password reset link.
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

    /**
     * Test user password reset.
     *
     * @return void
     */
    public function testUserPasswordReset()
    {
        $user = factory(User::class)->create();
        $token = hash_hmac('sha256', Str::random(40), 'Hashkey');
        DB::table('password_resets')->insert([
            'email'      => $user->email,
            'token'      => Hash::make($token),
            'created_at' => new Carbon(),
        ]);
        $url = $this->baseUrl() . route('password.reset', [
            'token' => $token,
            'email' => $user->email,
        ], false);

        $this->browse(function (Browser $browser) use ($user, $url) {
            $browser->visit($url)
                ->type('#email', $user->email)
                ->type('#password', 'password')
                ->type('#password-confirm', 'password')
                ->press('@submit')
                ->assertSee($user->name);
        });
    }
}
