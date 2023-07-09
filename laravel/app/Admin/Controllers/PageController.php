<?php

namespace App\Admin\Controllers;

use App\Models\Page;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Str;

class PageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'page';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Page());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('slug', __('Slug'));
        $grid->column('description', __('Description'));
        $grid->column('content', __('Content'));
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
        $show = new Show(Page::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('slug', __('Slug'));
        $show->field('description', __('Description'));
        $show->field('content', __('Content'));
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
        $form = new Form(new Page());

        $form->text('title', __('Title'))->rules('required');
        $form->text('slug', __('Slug'));
        $form->textarea('description', __('Description'));
        $form->tmeditor('content', __('Content'));
        $form->cropper('image', __('Image'));
        $form->saving(function (Form $form) {
            $form->slug = Str::slug($form->title);
        });
        $form->switch('active', __('Active'))->default(1);
        return $form;
    }
}
