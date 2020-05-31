<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\LaravelAdmin\Administrator;
use Encore\Admin\Auth\Database\Role;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Hash;

class AdministratorController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\Administrator';

    public function __construct()
    {
        $this->title = __('fields.Admins');
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Administrator());

        $grid->column('id', __('fields.Id'));
        $grid->column('name', __('fields.Name'));
        // @phpstan-ignore-next-line
        $grid->column('roles', trans('admin.roles'))->pluck('name')->label();
        $grid->column('username', __('fields.Username'));
        $grid->column('email', __('fields.Email'));
        $grid->column('created_at', __('fields.Created at'));
        $grid->column('updated_at', __('fields.Updated at'));

        // add onclick action
        $grid->rows(function (Grid\Row $row) {
            $row->setAttributes([
                'style'   => 'cursor: pointer;',
                // @phpstan-ignore-next-line
                'onclick' => "location.href='" . route('admin.administrators.show', ['administrator' => $row->id]) . "'"
            ]);
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Administrator::findOrFail($id));

        $show->field('id', __('fields.Id'));
        $show->field('name', __('fields.Name'));
        $show->field('roles', trans('admin.roles'))->as(function ($roles) {
            return $roles->pluck('name');
        })->label();
        $show->field('username', __('fields.Username'));
        $show->field('email', __('fields.Email'));
        $show->field('created_at', __('fields.Created at'));
        $show->field('updated_at', __('fields.Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $permissionModel = config('admin.database.permissions_model');
        $roleModel = config('admin.database.roles_model');

        $form = new Form(new Administrator());

        $form->display('id', 'ID');
        $form->text('name', __('fields.Name'))->rules('required|string|between:1,20');
        $form->text('username', __('fields.Username'))->rules('required|string|between:1,20');
        $form->email('email', __('fields.Email'))->rules('required|email');
        $form->password('password', __('fields.Password'))->rules('required|string|alpha_dash|confirmed|between:6,20');
        $form->password('password_confirmation', __('fields.Password Confirmation'))->rules('required')
            ->default(function ($form) {
                return $form->model()->password;
            });
        $form->ignore(['password_confirmation']);

        $form->display('created_at', trans('admin.created_at'));
        $form->display('updated_at', trans('admin.updated_at'));

        $form->saving(function (Form $form) {
            // @phpstan-ignore-next-line
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = Hash::make($form->password);
            }
        });

        $form->saved(function (Form $form) {
            // @phpstan-ignore-next-line
            $form->model()->roles()->save(Role::first());
        });

        return $form;
    }
}
