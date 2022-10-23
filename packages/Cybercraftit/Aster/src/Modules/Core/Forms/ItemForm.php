<?php

namespace Cybercraftit\Aster\Modules\Core\Forms;

use Kris\LaravelFormBuilder\Form;

class ItemForm extends Form
{
    public static $form_fields = [
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

    public static function set_form( $form_name, $form_fields = [] ) {
        if ( ! empty( $form_fields ) ) {
            self::$form_fields = $form_fields;

            //set form_name as hidden field
            self::$form_fields['form_name'] = [
                'type' => 'hidden',
                'value' => $form_name
            ];
        }
    }

    public function buildForm()
    {
        foreach ( self::$form_fields as $field_name => $field ) {
            $this
                ->add( $field_name, $field['type'],
                    $field
                );
        }
    }
}
