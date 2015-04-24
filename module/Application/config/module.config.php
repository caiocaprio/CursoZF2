<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'application-index-controller',
                        'action'     => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application/application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        'controller'    => 'application-index-controller',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                /*'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),*/
            ),
            'application-notfound' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/application/not-found',
                    'defaults' => array(
                        'controller' => 'application-error-controller',
                        'action'     => 'index',
                    ),
                ),
            ),
            'application-teste' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/application/teste',
                    'defaults' => array(
                        'controller' => 'application-index-controller',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'services' => array(
            'categories' => array(
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
                'font'        => 'caminho para um arquivos .font',
                'fontSize'    => 24,
                'height'    => 50,
                'width'        => 200,
                'imgDir'    => __DIR__ . '/../../../public/captcha',
                'imgUrl'    => '/captcha',
            ),
        ),

        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'application-index-controller' => 'Application\Controller\IndexController',
            'application-error-controller' => 'Application\Controller\ErrorController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
          /*  'application/application' => __DIR__ . '/../../application/layout/layout.phtml',*/
            'application/layout'      => __DIR__ . '/../../application/view/application/layout/layout.phtml',
            'layout/layout'           => __DIR__ . '/../../application/view/application/layout/layout.phtml',
            'error/404'               => __DIR__ . '/../../application/view/application/error/404.phtml',
            'error/index'             => __DIR__ . '/../../application/view/application/error/invalid.phtml',
            'default' => 'application/layout',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies'=>array(
            'ViewJsonStrategy','ViewFeedStrategy'
        ),
    ),
    'view_helpers'=>array(
        'invokables'=>array(
            'leftLinks'=>'Application\Helper\LeftLinks'
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),

);
