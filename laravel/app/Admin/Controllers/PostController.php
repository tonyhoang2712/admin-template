<?php

namespace App\Admin\Controllers;

use App\Models\Post;
use App\Models\Category;
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
        $grid->column('description', __('Description'));
        $grid->column('content', __('Content'));
        $grid->column('category_id', __('Category id'));
        $grid->column('tag', __('Tag'));
        $grid->column('image', __('Image'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show->field('tag', __('Tag'));
        $show->field('image', __('Image'));
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

        $form->text('title', __('Title'))->rules('required');
        $form->text('slug', __('Slug'));
        $form->textarea('description', __('Description'))->rules('required');
        $form->ckeditor('content', __('Content'))->rules('required');
        $form->multipleSelect('category_id', 'Category')
                ->options(Category::pluck('title', 'id'))
                ->rules('required');
        $form->image('image', __('Image'));
        //$form->multipleSelect('tags', 'Tags')->options(Tag::pluck('title', 'id'));
        return $form;
    }
}
