<?php

namespace App\Http\Controllers\Backend\Admin\Auth;

use Encore\Admin\Controllers\AuthController as BaseAuthController;
use Encore\Admin\Form;

class AuthController extends BaseAuthController
{
    /**
     * Model-form for user setting.
     *
     * @return Form
     */
    protected function settingForm()
    {
        $class = config('admin.database.users_model');
        $roleModel = config('admin.database.roles_model');

        $form = new Form(new $class());

        $form->display('username', trans('fields.Username'));
        $form->text('name', trans('fields.Name'))->rules('required');
        $form->multipleSelect('roles', trans('admin.roles'))
            ->options($roleModel::all()->pluck('name', 'id'))
            ->default($roleModel::where('name', 'Administrator')->first()->id)
            ->readonly();
        $form->password('password', trans('admin.password'))->rules('confirmed|required');
        $form->password('password_confirmation', trans('admin.password_confirmation'))->rules('required');

        $form->setAction(route('admin.setting'));

        $form->ignore(['password_confirmation']);

        $form->saving(function (Form $form) {
            // @phpstan-ignore-next-line
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = bcrypt($form->password);
            }
        });

        $form->saved(function (Form $form) {
            admin_toastr(trans('admin.update_succeeded'));

            return redirect(route('admin.setting'));
        });

        return $form;
    }
}
