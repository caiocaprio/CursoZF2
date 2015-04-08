<?php
namespace Base;

return array(
    'module_layouts' => array(
        'Market' => array(
            'layout'        =>  'market/layout/layout',
            'layout_error'  =>  'market/error/index',
            'layout_404'    =>  'market/error/404',
        ),
        'Application' => array(
            'layout'        =>  'application/layout/layout',
            'layout_error'  =>  'application/error/index',
            'layout_404'    =>  'application/error/404',
        ),
        'Default' => array(
            'layout'        =>  'application/layout/layout',
            'layout_error'  =>  'application/error/index',
            'layout_404'    =>  'application/error/404',
        ),
    ),
);
