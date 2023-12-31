<?php

namespace App\Admin\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Str;

class PostController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Post';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Post());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('slug', __('Slug'));
        $grid->column('category_id', __('Category id'));
        $grid->column('image', __('Image'));
        $grid->column('created_at', __('Created at'))->display(function ($value) {
            $datetime = \DateTime::createFromFormat('Y-m-d\TH:i:s.u\Z', $value);
            return $datetime->format('Y-m-d H:i:s');
        });
        $grid->column('updated_at', __('Updated at'))->display(function ($value) {
            $datetime = \DateTime::createFromFormat('Y-m-d\TH:i:s.u\Z', $value);
            return $datetime->format('Y-m-d H:i:s');
        });
        $grid->column('active', __('Active'));
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
        $show->field('title', __('Title'));
        $show->field('slug', __('Slug'));
        $show->field('description', __('Description'));
        $show->field('content', __('Content'));
        $show->field('category_id', __('Category id'));
        $show->field('tags', __('Tags'));
        $show->field('image', __('Image'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('active', __('Active'));

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

        $form->text('title', __('Title'))->rules('required');
        $form->text('slug', 'Slug')->creationRules(['unique:posts,slug']);
        $form->textarea('description', __('Description'))->rules('required');
        $form->tmeditor('content', __('Content'))->rules('required');
        $form->select('category_id', 'Category')
                ->options(Category::pluck('title', 'id'))
                ->rules('required');
        $form->image('image', __('Image'));

        $form->saving(function (Form $form) {
            $form->slug = Str::slug($form->title);
        });
        $form->select('tags', 'Tags')->options(Tag::pluck('title', 'id'));
        $form->switch('active', __('Active'))->default(1);
        return $form;
    }
}
