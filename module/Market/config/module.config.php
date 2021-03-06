<?php
/**
 * Created by PhpStorm.
 * User: caio.caprio
 * Date: 25/02/2015
 * Time: 16:34
 */

return array(

    'router' => array(
        'routes' => array(
            /*'home' => array(
                'type' => 'Literal',
                'options'=>array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' =>'market-index-controller',
                        'action' =>'index'
                    ),
                ),
            ),*/



            'market' => array(
                'type' => 'Literal',
                'options'=>array(
                    'route' => '/market',
                    'defaults' => array(
                        'controller' =>'market-index-controller',
                        'action' =>'index'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]][/]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'controller' =>'market-index-controller',
                                'action' =>'index'
                            ),
                        ),
                    ),
                ),
            ),

            'market-notfound' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/market/not-found',
                    'defaults' => array(
                        'controller' => 'market-view-controller',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '[/]',
                            'defaults' => array(
                                'controller' =>'market-view-controller',
                                'action' =>'index'
                            ),
                        ),
                    ),
                ),
            ),

            'market-post' => array(
                'type' => 'Literal',
                'options'=>array(
                    'route' => '/market/post',
                    'defaults' => array(
                        'controller' =>'market-post-controller',
                        'action' =>'index'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '[/]',
                            'defaults' => array(
                                'controller' =>'market-post-controller',
                                'action' =>'index'
                            ),
                        ),
                    ),
                ),

            ),

            'market-view' => array(
                'type' => 'Literal',
                'options'=>array(
                    'route' => '/market/view',
                    'defaults' => array(
                        'controller' =>'market-view-controller',
                        'action' =>'index'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    /**/
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '[/]',
                            'defaults' => array(
                                'action' => 'index'
                            ),
                        ),
                    ),

                    'main' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/main[/:category]',
                            'defaults' => array(
                                'action' => 'index'
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'default' => array(
                                'type'    => 'Segment',
                                'options' => array(
                                    'route'    => '[/]',
                                    'defaults' => array(
                                        'action' => 'index'
                                    ),
                                ),
                            ),
                        ),
                    ),

                    'item' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/item[/:itemId]',
                            'defaults' => array(
                                'action' => 'item',
                            ),
                            'constraints' =>array(
                                'itemId' => '[0-9]*',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'default' => array(
                                'type'    => 'Segment',
                                'options' => array(
                                    'route'    => '[/]',
                                    'defaults' => array(
                                        'action' => 'item'
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),

    'controllers' => array(
        'invokables' => array(

           // 'market-post-controller' => 'Market\Controller\PostController',
            //'index' => 'Market\Controller\IndexController',
            //'view' => 'Market\Controller\ViewController',
            'market-error-controller' => 'Market\Controller\ErrorController',
        ),
        'factories'=>array(
            'market-post-controller' => 'Market\Factory\PostControllerFactory',
            'market-index-controller' => 'Market\Factory\IndexControllerFactory',
            'market-view-controller' => 'Market\Factory\ViewControllerFactory',
        ),
        'aliases'=>array(
            'alt'=>'market-view-controller'
        ),
    ),

    'service_manager'=>array(
        'factories' =>array(
            'general-adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
            'market-post-form' => 'Market\Factory\PostFormFactory',
            'market-post-filter' => 'Market\Factory\PostFilterFactory',
            'listings-table' => 'Market\Factory\ListingsTableFactory',
        ),
        'services' => array(
            'market-categories' => array(
                'barter',
                'beauty',
                'clothing',
                'computer',
                'entertainment',
                'free',
                'garden',
                'general'
            ),
            'market-expire-days' => array(
                0  => 'Nunca',
                1  => 'Amanhã',
                7  => 'Daqui há uma semana',
                30 => 'Daqui um mês',
            ),
            'market-captcha-options' => array(
                'expiration' => 300,
                'font'        => __DIR__ . '/../../../public/fonts/tahoma.ttf',
                'fontSize'    => 24,
                'height'    => 50,
                'width'        => 200,
                'imgDir'    => __DIR__ . '/../../../public/captcha',
                'imgUrl'    => '../captcha',
            ),
        ),
    ),

    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'market/layout'      => __DIR__ . '/../../market/view/market/layout/layout.phtml',
            'layout/layout'           => __DIR__ . '/../../market/view/market/layout/layout.phtml',
            'error/404'               => __DIR__ . '/../../market/view/market/error/404.phtml',
            'error/index'             => __DIR__ . '/../../market/view/market/error/index.phtml',
            'default' => 'market/layout',

        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),

    ),
);