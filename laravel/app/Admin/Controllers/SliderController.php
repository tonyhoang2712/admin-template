<?php

namespace App\Admin\Controllers;

use App\Models\Slider;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SliderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Slider';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Slider());

        $grid->column('id', __('Id'));
        $grid->column('position_id', __('Position id'));
        $grid->column('image', __('Image'));
        $grid->column('desciption', __('Desciption'));
        $grid->column('link', __('Link'));
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
        $show = new Show(Slider::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('position_id', __('Position id'));
        $show->field('image', __('Image'));
        $show->field('desciption', __('Desciption'));
        $show->field('link', __('Link'));
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
        $form = new Form(new Slider());

        $form->number('position_id', __('Position id'))->rules('required');;
        $form->cropper('image', __('Image'))->rules('required');
        $form->tmeditor('desciption', __('Desciption'));
        $form->url('link', __('Link'));
        $form->switch('active', __('Active'))->default(1);

        return $form;
    }
}
