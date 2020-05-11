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
            'username'    => 'user',
            'email'       => 'user@example.com',
            'password'    => Hash::make('password'),
        ]);

        factory(User::class, 100)->create();
    }
}
