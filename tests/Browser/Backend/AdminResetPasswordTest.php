<?php

namespace Tests\Browser\Frontend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Support\Str;
use App\Models\Administrator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Browser\Pages\Backend\AdminLoginPage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Pages\Backend\AdminForgotPasswordPage;

class AdminResetPasswordTest extends DuskTestCase
{
    use DatabaseMigrations;
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
            $browser->visit(new AdminLoginPage())
                ->clickLink(__('Forgot Your Password?'))
                ->on(new AdminForgotPasswordPage())
                ->type('@email', $user->email)
                ->press('@submit')
                ->assertSee(__(Password::RESET_LINK_SENT));
        });
    }

    /**
     * Test admin password reset.
     *
     * @return void
     */
    public function testAdminPasswordReset()
    {
        $user = factory(Administrator::class)->create();
        $token = hash_hmac('sha256', Str::random(40), 'Hashkey');
        DB::table('password_resets')->insert([
            'email' => $user->email,
            'token' => Hash::make($token),
            'created_at' => new Carbon(),
        ]);
        $url = $this->baseUrl() . route('admin.password.reset', [
            'token' => $token,
            'email' => $user->email,
        ], false);

        $this->browse(function (Browser $browser) use ($user, $url) {
            $browser->visit($url)
                ->screenshot('before')
                ->type('#email', $user->email)
                ->type('#password', 'password')
                ->type('#password-confirm', 'password')
                ->press('@submit')
                ->assertSee($user->name);
        });
    }
}
