<?php

namespace Cybercraftit\Aster\Modules\Post\Forms;

use Kris\LaravelFormBuilder\Form;

class PostForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('post_title', 'text',
                [
                    'label' => 'Post title',
                    'rules' => 'required|min:5',
                    'error_messages' => [
                        'post_title.required' => 'The title field is mandatory.'
                    ]
                ]
            )
//            ->add('post_name', 'text' )
            ->add('post_content', 'textarea',
                [
                    'label' => 'Post content',
                    'rules' => 'required|max:5000',
                    'error_messages' => [
                        'post_content.required' => 'The content field is mandatory.'
                    ]
                ]
            )
            ->add( 'post_excerpt', 'textarea',
                [
                    'label' => 'Post excerpt',
                    'rules' => 'required|max:1000',
                    'error_messages' => [
                        'post_excerpt.required' => 'The excerpt field is mandatory.'
                    ]
                ]
            )
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
            ->add('submit', 'submit', ['label' => 'Save form'])
        ;
    }
}
