<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Tree;
use Illuminate\Support\Facades\Route;


class CategoryController extends Controller
{
    use ModelForm;

    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('Categories');
            $content->body(
                Category::tree(function ($tree) {
                    $tree->branch(function ($branch) {
                        $src = config('admin.upload.host') . '/' . $branch['image'] ;
                        $logo = "<img src='$src' style='max-width:30px;max-height:30px' class='img'/>";
                
                        return "{$branch['id']} - {$branch['title']} $logo";
                    });
                })
            );
        });
    }

    // protected function form()
    // {
    //     $form = new Form(new Category());

    //     $form->text('title', 'Title')->rules('required');
    //     $form->text('slug', 'Slug')->creationRules(['unique:categories,slug']);
    //     $form->select('parent_id', 'Parent Category')->options(Category::pluck('title', 'id'));
    //     // $form->image('image', __('Image'))->removable();
    //     $form->cropper('image', __('Image'))->cRatio(100,100);
    //     $form->number('order', 'Order')->default(0);

    //     $form->saving(function (Form $form) {
    //         $form->slug = Str::slug($form->title);
    //     });
    //     $form->switch('active', __('Active'))->default(1);

    //     return $form;
    // }

    public function create(Content $content)
    {
        return $content
            ->header('Create Category')
            ->body($this->form());
    }

    public function store()
    {
        return $this->form()->store();
    }

    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit Category')
            ->body($this->form($id)->edit($id));
    }

    protected function form($id = 0)
    {
        return Category::form(function (Form $form) use ($id) {
            $form->text('title', 'Title')->rules('required');
            $form->text('slug', 'Slug')->creationRules(['unique:categories,slug']);

            $form->select('parent_id', 'Parent Category')->options(function() use ($id) {

                $result = $this->buildCategoryOptions();

                return collect($result)->filter(function ($item, $key) use ($id) {
                    return $key != $id;
                });

            })->rules('required');

            $form->cropper('image', __('Image'))->cRatio(100,100);
            $form->number('order', 'Order')->default(0);
    
            $form->saving(function (Form $form) {
                $form->slug = Str::slug($form->title);
            });
            $form->switch('active', __('Active'))->default(1);
        });
    }

    public function show($id, Content $content)
    {
        return $content
            ->header('Category Details')
            ->body($this->detail($id));
    }

    protected function detail($id)
    {
        $show = new Show(Category::findOrFail($id));
        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('slug', __('Slug'));
        $show->field('parent.title', __('Parent'));
        $show->field('order', __('Order'));
        $show->field('image', __('Image'))->image();
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }
}