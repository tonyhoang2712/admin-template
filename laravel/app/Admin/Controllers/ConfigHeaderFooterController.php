<?php

namespace App\Admin\Controllers;

use App\Models\ConfigHeaderFooter;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ConfigHeaderFooterController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ConfigHeaderFooter';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ConfigHeaderFooter());

        $grid->column('id', __('Id'));
        $grid->column('header_title', __('Header title'));
        $grid->column('logo', __('Logo'));
        $grid->column('favicon', __('Favicon'));
        $grid->column('email', __('Email'));
        $grid->column('phone', __('Phone'));
        $grid->column('info', __('Info'));
        $grid->column('address_1', __('Address 1'));
        $grid->column('address_2', __('Address 2'));
        $grid->column('address_3', __('Address 3'));
        $grid->column('google_ads', __('Google ads'));
        $grid->column('google_console', __('Google console'));
        $grid->column('google_map', __('Google map'));
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
        $show = new Show(ConfigHeaderFooter::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('header_title', __('Header title'));
        $show->field('logo', __('Logo'));
        $show->field('favicon', __('Favicon'));
        $show->field('email', __('Email'));
        $show->field('phone', __('Phone'));
        $show->field('info', __('Info'));
        $show->field('address_1', __('Address 1'));
        $show->field('address_2', __('Address 2'));
        $show->field('address_3', __('Address 3'));
        $show->field('google_ads', __('Google ads'));
        $show->field('google_console', __('Google console'));
        $show->field('google_map', __('Google map'));
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
        $form = new Form(new ConfigHeaderFooter());
        $form->setWidth(12); // Set the form width to full (12 columns)
        $form->column(1/2, function ($form) {
            $form->text('header_title', __('Header title'));
            $form->cropper('logo', __('Logo'));
            $form->cropper('favicon', __('Favicon'))->cRatio(50,50);
            $form->email('email', __('Email'));
            $form->mobile('phone', __('Phone'));
        });
        $form->column(1/2, function ($form) {
            $form->tmeditor('info', __('Info'));
            $form->text('address_1', __('Address 1'));
            $form->text('address_2', __('Address 2'));
            $form->text('address_3', __('Address 3'));
            $form->textarea('google_ads', __('Google ads'));
            $form->textarea('google_console', __('Google console'));
            $form->textarea('google_map', __('Google map'));
        });

        return $form;
    }
}
