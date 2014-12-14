<?php

return array(

    /*
    |----------------------------------------------------------------------
    | Default Drivr
    |----------------------------------------------------------------------
    |
    | Set default driver for Orchestra\Widget.
    |
    */

    'default' => 'placeholder.default',

    /*
    |----------------------------------------------------------------------
    | Menu Configuration
    |----------------------------------------------------------------------
    */

    'menu' => array(
        'defaults' => array(
            'attributes' => array(),
            'icon'       => '',
            'link'       => '#',
            'title'      => '',
        ),
    ),

    /*
    |----------------------------------------------------------------------
    | Pane Configuration
    |----------------------------------------------------------------------
    */

    'pane' => array(
        'defaults' => array(
            'attributes' => array(),
            'title'      => '',
            'content'    => '',
            'html'       => '',
        ),
    ),

    /*
    |----------------------------------------------------------------------
    | Placeholder Configuration
    |----------------------------------------------------------------------
    */

    'placeholder' => array(
        'defaults' => array(
            'value' => '',
        ),
    ),
);