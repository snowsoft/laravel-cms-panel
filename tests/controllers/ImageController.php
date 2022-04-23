<?php

namespace Tests\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Http\Controllers\AdminController;
use Encore\Admin\Table;
use Tests\Models\Image;

class ImageController extends AdminController
{
    protected $title = 'Images';

    /**
     * Make a table builder.
     *
     * @return Table
     */
    protected function table()
    {
        $table = new Table(new Image());

        $table->id('ID')->sortable();

        $table->created_at();
        $table->updated_at();

        $table->disableFilter();

        return $table;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Image());

        $form->display('id', 'ID');

        $form->image('image1');
        $form->image('image2')->rotate(90);
        $form->image('image3')->flip('v');
        $form->image('image4')->move(null, 'renamed.jpeg');
        $form->image('image5')->name(function ($file) {
            return 'asdasdasdasdasd.'.$file->guessExtension();
        });
        $form->image('image6')->uniqueName();

        $form->display('created_at', 'Created At');
        $form->display('updated_at', 'Updated At');

        return $form;
    }
}
