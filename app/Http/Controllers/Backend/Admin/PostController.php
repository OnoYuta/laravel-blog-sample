<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Post;
use App\Repositories\Backend\Contract\PostRepositoryContract;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\Post';
    private $post;

    /**
     * Undocumented function
     *
     * @param PostRepositoryContract $post
     */
    public function __construct(PostRepositoryContract $post)
    {
        $this->post = $post;
    }

    /**
     * Get content title.
     *
     * @return string
     */
    protected function title()
    {
        return trans('fields.Posts');
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Post());

        $grid->column('id', __('fields.Id'));
        $grid->column('administrator_id', __('fields.Administrator id'));
        $grid->column('title', __('fields.Title'));
        $grid->column('contents', __('fields.Contents'));
        $grid->column('status', __('fields.Status'));
        $grid->column('published_at', __('fields.Published at'));

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

        $show->field('id', __('fields.Id'));
        $show->field('administrator_id', __('fields.Administrator id'));
        $show->field('title', __('fields.Title'));
        $show->field('contents', __('fields.Contents'));
        $show->field('status', __('fields.Status'));
        $show->field('published_at', __('fields.Published at'));
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
        $form = new Form(new Post());

        $form->hidden('administrator_id', __('fields.Administrator id'))
            ->value(Auth::guard('admin')->user()->getAttribute('id'));
        $form->text('title', __('fields.Title'))
            ->required();
        $form->text('contents', __('fields.Contents'))
            ->required();
        $form->select('status', __('fields.Status'))
            ->options(collect(config('fields.post_status'))->mapWithKeys(function ($value) {
                return [$value => trans('fields.' . $value)];
            }))
            ->default('draft')
            ->rules([
                'bail',
                'required',
                Rule::in(config('fields.post_status')),
            ]);
        $form->datetime('published_at', __('fields.Published at'))
            ->default(date('Y-m-d H:i:s'))
            ->rules([
                'bail',
                'required',
                'after_or_equal:today',
            ], [
                'after_or_equal' => '公開日には、本日以降の日付を指定してください。'
            ]);

        // 編集時は新たなバリデーションルールを作成する
        if (! Str::contains(request()->url(), 'create') && $postId = (int) request()->post) {
            return $this->addUpdateRules($form, $postId);
        }

        return $form;
    }

    /**
     * Add updateRules for Form
     *
     * @param Form $form
     * @param int $postId
     * @return Form
     */
    private function addUpdateRules(Form $form, int $postId): Form
    {
        // 現在のモデルを取得する
        $post = $this->post->find($postId);

        // 設定済みの公開日を取得する
        $publishedAt = $post->getAttribute('published_at');
        if ($publishedAt instanceof Carbon && $publishedAt->lessThan(Carbon::now())) {
            // 設定済みの公開日をまだ迎えていない場合は、設定済みの公開日以降の日付を選択できる
            $startDatetime = $publishedAt;
        } else {
            // 設定済みの公開日をもう迎えている場合は、本日以降の日付を選択できる
            $startDatetime = Carbon::now();
        }

        $form->builder()->field('published_at')->updateRules([
            'bail',
            'required',
            'after_or_equal:' . $startDatetime->toDatetimeString(),
        ], [
            'after_or_equal' => '公開日には、' . $startDatetime->format('Y年m月d日 H時i分s秒') . '以降の日付を指定してください。'
        ]);

        return $form;
    }
}
