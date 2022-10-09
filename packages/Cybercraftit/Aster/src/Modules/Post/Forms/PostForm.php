<?php

namespace Cybercraftit\Aster\Modules\Post\Forms;

use Kris\LaravelFormBuilder\Form;

class PostForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('post_title', 'text' )
//            ->add('post_name', 'text' )
            ->add('post_content', 'textarea' )
            ->add( 'post_excerpt', 'textarea' )
            ->add('post_status', 'select', [
                'choices' => ['draft' => 'Draft', 'publish' => 'Publish', 'pending' => 'Pending Review', 'private' => 'Private', 'trash' => 'Trash'],
                'selected' => 'draft',
                'empty_value' => '=== Select post status ==='
            ])
            ->add('comment_status', 'select', [
                'choices' => ['open' => 'Allow Comments', 'close' => 'Do Not Allow Comments'],
                'selected' => 'open',
                'empty_value' => '=== Select comment status ==='
            ])
        ;
    }
}
