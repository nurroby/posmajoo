<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------

    public $loginadmin = [
        'username' => 'required|alpha_numeric|min_length[5]|max_length[20]',
        'password' => 'required|min_length[8]|max_length[20]'
    ];
    public $createCategory = [        
        'name' => 'required',
        'description' => 'required',
        'image' => [
            'required',
            'uploaded[image]',
            'mime_in[image,image/jpg,image/jpeg,image/gif,image/png]',
            'max_size[image,4096]',
        ]
    ];
    public $editCategory = [        
        'name' => 'alpha_numeric|min_length[5]|max_length[20]',
        'description' => 'alpha_numeric|min_length[5]|max_length[200]',
        'image' => [
            'uploaded[image]',
            'mime_in[image,image/jpg,image/jpeg,image/gif,image/png]',
            'max_size[image,4096]',
        ]
    ];
}
