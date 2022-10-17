<?php

namespace Cybercraftit\Aster\Modules\Post\Forms;

use Kris\LaravelFormBuilder\Form;

class PostForm extends Form
{
    public $form_fields = [
        'post_title' => [
            'type' => 'text',
            'label' => 'Post title',
            'rules' => 'required|min:5',
            'error_messages' => [
                'post_title.required' => 'The title field is mandatory.'
            ]
        ],
        'post_content' => [
            'type' => 'textarea',
            'label' => 'Post content',
            'rules' => 'required|max:5000',
            'error_messages' => [
                'post_content.required' => 'The content field is mandatory.'
            ]
        ],
        'post_excerpt' => [
            'type' => 'textarea',
            'label' => 'Post excerpt',
            'rules' => 'required|max:1000',
            'error_messages' => [
                'post_excerpt.required' => 'The excerpt field is mandatory.'
            ]
        ],
        'post_status' => [
            'type' => 'select',
            'choices' => ['draft' => 'Draft', 'publish' => 'Publish', 'pending' => 'Pending Review', 'private' => 'Private', 'trash' => 'Trash'],
            'selected' => 'draft',
            'empty_value' => '=== Select post status ==='
        ],
        'comment_status' => [
            'type' => 'select',
            'choices' => ['open' => 'Allow Comments', 'close' => 'Do Not Allow Comments'],
            'selected' => 'open',
            'empty_value' => '=== Select comment status ==='
        ],
        'submit' => [ 'type' => 'submit', 'label' => 'Save form']

    ];

    public function set_form( $form_fields = [] ) {
        if ( ! empty( $form_fields ) ) {
            $this->form_fields = $form_fields;
        }
        return $this;
    }

    public function buildForm()
    {
        foreach ( $this->form_fields as $field_name => $field ) {
            $this
                ->add( $field_name, $field['type'],
                    $field
                );
        }
    }
}
