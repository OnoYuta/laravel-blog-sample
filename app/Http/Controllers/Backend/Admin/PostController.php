<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Post;
use App\Repositories\Backend\Contract\PostRepositoryContract;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
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

    /**
     * @var PostRepositoryContract
     */
    private $post;

    /**
     * @param PostRepositoryContract $post
     */
    public function __construct(PostRepositoryContract $post)
    {
        $this->post = $post;
    }

    /**
     * Show interface.
     *
     * @param mixed   $id
     * @param Content $content
     *
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description['show'] ?? trans('admin.show'))
            ->body($this->detail($id))
            ->row(function (Row $row) use ($id) {
                $row->column(12, function (Column $column) use ($id) {
                    $column->append($this->preview($id));
                });
            });
    }

    /**
     * Make a show builder for contents preview.
     *
     * @param mixed $id
     * @return Show
     */
    public function preview($id)
    {
        $html = $this->post->find($id)->contents;

        return view('backend.post.preview')
            ->with(['html' => $html]);
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
        // @phpstan-ignore-next-line
        $grid->column('title', __('fields.Title'))->limit(10);
        // @phpstan-ignore-next-line
        $grid->column('contents', __('fields.Contents'))
            ->display(function () {
                // @phpstan-ignore-next-line
                return htmlspecialchars($this->getAttribute('contents'), ENT_QUOTES, 'UTF-8', false);
            })
            ->limit(20);
        $grid->column('status', __('fields.Status'))
            ->using((array) trans('fields'));
        $grid->column('published_at', __('fields.Published at'))
            ->display(function () {
                // @phpstan-ignore-next-line
                return $this->getAttribute('published_at')->format('Y年m月d日');
            });
        // @phpstan-ignore-next-line
        $grid->administrator(__('fields.Author'))
            ->display(function ($administrator) {
                return $administrator['name'];
            });

        // add onclick action
        $grid->rows(function (Grid\Row $row) {
            $row->setAttributes([
                'style'   => 'cursor: pointer;',
                // @phpstan-ignore-next-line
                'onclick' => "location.href='" . route('admin.posts.show', ['post' => $row->id]) . "'"
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
        $show = new Show(Post::findOrFail($id));

        $show->field('id', __('fields.Id'));
        // @phpstan-ignore-next-line
        $show->administrator(__('fields.Author'))
            ->as(function ($administrator) {
                return $administrator['name'];
            });
        $show->field('title', __('fields.Title'));
        $show->field('contents', __('fields.Contents'));
        $show->field('status', __('fields.Status'))
            ->using((array) trans('fields'));
        $show->field('published_at', __('fields.Published at'))
            ->as(function () {
                // @phpstan-ignore-next-line
                return $this->getAttribute('published_at')->format('Y年m月d日 H時i分s秒');
            });
        $show->field('created_at', __('fields.Created at'))
            ->as(function () {
                // @phpstan-ignore-next-line
                return $this->getAttribute('created_at')->format('Y年m月d日 H時i分s秒');
            });
        $show->field('updated_at', __('fields.Updated at'))
            ->as(function () {
                // @phpstan-ignore-next-line
                return $this->getAttribute('updated_at')->format('Y年m月d日 H時i分s秒');
            });
        $show->divider();

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
        // @phpstan-ignore-next-line
        $form->ckeditor('contents', __('fields.Contents'))
            ->required()
            ->help(__('helps.show_html'));
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
