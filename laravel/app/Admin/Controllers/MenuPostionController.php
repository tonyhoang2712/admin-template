<?php

namespace App\Admin\Controllers;

use App\Models\MenuPosition;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MenuPostionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'MenuPosition';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new MenuPosition());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('slug', __('Slug'));
        $grid->column('created_at', __('Created at'))->display(function ($value) {
            $datetime = \DateTime::createFromFormat('Y-m-d\TH:i:s.u\Z', $value);
            return $datetime->format('Y-m-d H:i:s');
        });
        $grid->column('updated_at', __('Updated at'))->display(function ($value) {
            $datetime = \DateTime::createFromFormat('Y-m-d\TH:i:s.u\Z', $value);
            return $datetime->format('Y-m-d H:i:s');
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
        $show = new Show(MenuPosition::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('slug', __('Slug'));
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
        $form = new Form(new MenuPosition());

        $form->text('title', __('Title'));
        $form->text('slug', __('Slug'));

        return $form;
    }
}
