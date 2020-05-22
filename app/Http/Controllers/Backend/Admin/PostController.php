<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Post;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PostController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\Post';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Post());

        $grid->column('id', __('Id'));
        $grid->column('administrator_id', __('Administrator id'));
        $grid->column('title', __('Title'));
        $grid->column('contents', __('Contents'));
        $grid->column('status', __('Status'));
        $grid->column('published_at', __('Published at'));

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
        $show = new Show(Post::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('administrator_id', __('Administrator id'));
        $show->field('title', __('Title'));
        $show->field('contents', __('Contents'));
        $show->field('status', __('Status'));
        $show->field('published_at', __('Published at'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Post());

        $form->number('administrator_id', __('Administrator id'));
        $form->text('title', __('Title'));
        $form->text('contents', __('Contents'));
        $form->text('status', __('Status'));
        $form->datetime('published_at', __('Published at'))->default(date('Y-m-d H:i:s'));

        return $form;
    }
}
