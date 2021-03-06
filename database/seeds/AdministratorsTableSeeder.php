<?php

use App\Models\Administrator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdministratorsTableSeeder extends Seeder
{
    private $table = 'administrators';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table($this->table)->truncate();

        factory(Administrator::class)->create([
            'username'    => config('account.sample.admin.username'),
            'email'       => 'admin@example.com',
            'password'    => Hash::make(config('account.sample.admin.password')),
        ]);

        factory(Administrator::class, 10)->create();
    }
}
