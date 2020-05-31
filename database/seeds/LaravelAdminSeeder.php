<?php

use App\Models\LaravelAdmin\Administrator;
use Encore\Admin\Auth\Database\Menu;
use Encore\Admin\Auth\Database\Permission;
use Encore\Admin\Auth\Database\Role;
use Illuminate\Database\Seeder;

class LaravelAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create a role.
        Role::truncate();
        Role::create([
            'name' => 'Administrator',
            'slug' => 'administrator',
        ]);

        // add role to user.
        foreach (Administrator::all() as $administrator) {
            $administrator->roles()->save(Role::first());
        }

        //create a permission
        Permission::truncate();
        Permission::insert([
            [
                'name'        => 'All permission',
                'slug'        => '*',
                'http_method' => '',
                'http_path'   => '*',
            ],
            [
                'name'        => 'Dashboard',
                'slug'        => 'dashboard',
                'http_method' => 'GET',
                'http_path'   => '/',
            ],
            [
                'name'        => 'Login',
                'slug'        => 'login',
                'http_method' => '',
                'http_path'   => "/login\r\n/logout",
            ],
            [
                'name'        => 'User setting',
                'slug'        => 'setting',
                'http_method' => 'GET,PUT',
                'http_path'   => '/setting',
            ],
            [
                'name'        => 'Auth management',
                'slug'        => 'management',
                'http_method' => '',
                'http_path'   => "/roles\r\n/permissions\r\n/menu\r\n/logs",
            ],
        ]);

        Role::first()->permissions()->save(Permission::first());

        // add default menus.
        Menu::truncate();
        Menu::insert([
            [
                'parent_id' => 0,
                'order'     => 1,
                'title'     => trans('fields.Dashboard'),
                'icon'      => 'fa-bar-chart',
                'uri'       => '/',
            ],
            [
                'parent_id' => 0,
                'order'     => 2,
                'title'     => trans('fields.Management'),
                'icon'      => 'fa-tasks',
                'uri'       => '',
            ],
            [
                'parent_id' => 2,
                'order'     => 3,
                'title'     => trans('fields.Admins'),
                'icon'      => 'fa-users',
                'uri'       => 'administrators',
            ],
            [
                'parent_id' => 2,
                'order'     => 4,
                'title'     => trans('fields.Roles'),
                'icon'      => 'fa-user',
                'uri'       => 'roles',
            ],
            [
                'parent_id' => 2,
                'order'     => 5,
                'title'     => trans('fields.Permission'),
                'icon'      => 'fa-ban',
                'uri'       => 'permissions',
            ],
            [
                'parent_id' => 2,
                'order'     => 6,
                'title'     => trans('fields.Menu'),
                'icon'      => 'fa-bars',
                'uri'       => 'menu',
            ],
            [
                'parent_id' => 2,
                'order'     => 7,
                'title'     => trans('fields.Log'),
                'icon'      => 'fa-history',
                'uri'       => 'logs',
            ],
            [
                'parent_id' => 0,
                'order'     => 8,
                'title'     => trans('fields.Posts'),
                'icon'      => 'fa-edit',
                'uri'       => 'posts',
            ],
        ]);

        // add role to menu.
        Menu::find(2)->roles()->save(Role::first());
    }
}
