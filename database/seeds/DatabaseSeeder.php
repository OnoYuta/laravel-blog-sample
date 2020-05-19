<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //シーダーを実行する前に、この接続の外部キーチェックを無効にする
        if (config('database.default') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        $this->call(UsersTableSeeder::class);
        $this->call(AdministratorsTableSeeder::class);

        // 外部キーチェックを明示的に有効に戻す（これを省略しても接続が終了すれば元に戻る）
        if (config('database.default') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
