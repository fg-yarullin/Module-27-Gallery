<?php

function getRoutes():array {
    return [
        '' => [
            'GET' => [
                'controller' => 'Controller_Main',
                'action' => 'action_index'
            ],
            'model' => 'Model_Main'
        ],

        'user' => [
            'GET' => [
                'controller' => 'Controller_User',
                'action' => 'action_index'
            ],
            'model' => 'Model_User'
        ],

        'user/register' => [
            'GET' => [
                'controller' => 'Controller_Register',
                'action' => 'registrationForm'
            ],
            'POST' => [
                'controller' => 'Controller_Register',
                'action' => 'registerUser'
            ],
            'model' => 'stdClass'
        ],

        'user/success' => [
            'GET' => [
                'controller' => 'Controller_Register',
                'action' => 'success'
            ],
            'model' => 'stdClass'
        ],
        
        'about' => [
            'GET' => [
                'controller' => 'Controller_About',
                'action' => 'action_index'
            ],
            'model' => 'Model_About'
        ],

        'contacts' => [
            'GET' => [
                'controller' => 'Controller_Contacts',
                'action' => 'action_index'
            ],
            'model' => 'Model_Contacts'
        ],

        'portfolio' => [
            'GET' => [
                'controller' => 'Controller_Portfolio',
                'action' => 'action_index'
            ],
            'model' => 'Model_Portfolio'
        ],

        'login' => [
            'GET' => [
                'controller' => 'Controller_Login',
                'action' => 'loginForm'
            ],
            'POST' => [
                'controller' => 'Controller_Login',
                'action' => 'processLogin'
            ],
            'model' => 'stdClass'
        ],

        'login/success' => [
            'GET' => [
                'controller' => 'Controller_Login',
                'action' => 'success'
            ],
            'model' => 'stdClass',
            'login' => true
        ],

        'login/error' => [
            'GET' => [
                'controller' => 'Controller_Login',
                'action' => 'error'
            ],
            'model' => 'stdClass'
        ],

        'logout' => [
            'GET' => [
                'controller' => 'Controller_Login',
                'action' => 'logout'
            ],
            'model' => 'stdClass'
        ],

        'gallery' => [
            'GET' => [
                'controller' => 'Controller_Gallery',
                'action' => 'action_index'
            ],
            'POST' => [
                'controller' => 'Controller_Gallery',
                'action' => 'action_showimage'
            ],
            'model' => 'Model_Gallery'
        ],

//         'gallery/showimage' => [
//             'POST' => [
//                 'controller' => 'Controller_Gallery',
//                 'action' => 'action_showimage'
//             ],
//             'model' => 'Model_Gallery'
//         ],

        'gallery/edit' => [
            'POST' => [
                'controller' => 'Controller_Gallery',
                'action' => 'action_save'
            ],
            'GET' => [
                'controller' => 'Controller_Gallery',
                'action' => 'action_edit'
            ],
            'model' => 'Model_Gallery',
            'login' => true
        ],

        'gallery/add' => [
            'POST' => [
                'controller' => 'Controller_Gallery',
                'action' => 'action_save'
            ],
            'GET' => [
                'controller' => 'Controller_Gallery',
                'action' => 'action_addImageForm'
            ],
            // 'GET' => [
            //     'controller' => 'Controller_Gallery',
            //     'action' => 'action_edit'
            // ],
            'model' => 'Model_Gallery',
            'login' => true
        ],

        'gallery/delete' => [
            'POST' => [
                'controller' => 'Controller_Gallery',
                'action' => 'action_delete_image'
            ],
            'model' => 'Model_Gallery',
            'login' => true
        ],

        'gallery/addcomment' => [
            'POST' => [
                'controller' => 'Controller_Gallery',
                'action' => 'action_addcomment'
            ],
            'model' => 'Model_Gallery'
        ],

        'gallery/deletecomment' => [
            'POST' => [
                'controller' => 'Controller_Gallery',
                'action' => 'action_deletecomment'
            ],
            'model' => 'Model_Gallery'
        ],
    ];
}