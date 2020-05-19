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
        if (env('DB_CONNECTION') == 'mysql') {
            DB::table($this->table)->truncate();
        } elseif (env('DB_CONNECTION') == 'sqlite') {
            DB::statement('DELETE FROM ' . $this->table);
        } else {
            //For PostgreSQL or anything else
            DB::statement('TRUNCATE TABLE ' . $this->table . ' CASCADE');
        }

        factory(User::class)->create([
            'username'    => 'user',
            'email'       => 'user@example.com',
            'password'    => Hash::make('password'),
        ]);

        factory(User::class, 100)->create();
    }
}
