<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    private $table = 'users';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table($this->table)->truncate();

        factory(User::class)->create([
            'username'    => config('account.sample.user.username'),
            'email'       => 'user@example.com',
            'password'    => Hash::make(config('account.sample.user.password')),
        ]);

        factory(User::class, 100)->create();
    }
}
