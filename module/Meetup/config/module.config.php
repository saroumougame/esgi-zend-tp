<?php

declare(strict_types=1);

use Meetup\Form\MeetupsForm;
use Zend\Router\Http\Literal;
use Meetup\Controller;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'meetups' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/meetups',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'add' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/new',
                            'defaults' => [
                                'action'     => 'add',
                            ],
                        ],
                    ],
                    'delete' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/delete[/:id]',
                            'defaults' => [
                                'controller' => Controller\IndexController::class,
                                'action'     => 'delete',
                            ],
                        ],
                    ],
                    'edit' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/edit[/:id]',
                            'defaults' => [
                                'controller' => Controller\IndexController::class,
                                'action'     => 'edit',
                            ],
                        ],
                    ],
                    'show' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/show[/:id]',
                            'defaults' => [
                                'controller' => Controller\IndexController::class,
                                'action'     => 'show',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Controller\IndexControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            MeetupsForm::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'meetup/index/index' => __DIR__ . '/../view/meetup/index/index.phtml',
            'meetup/index/add' => __DIR__ . '/../view/meetup/index/add.phtml',
            'meetup/index/edit' => __DIR__ . '/../view/meetup/index/edit.phtml',
            'meetup/index/show' => __DIR__ . '/../view/meetup/index/show.phtml',
        ],
    ],
    'doctrine' => [
        'driver' => [
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'meetup_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    __DIR__.'/../src/Entity/',
                ],
            ],

            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => [
                'drivers' => [
                    // register `application_driver` for any entity under namespace `Application\Entity`
                    'Meetup\Entity' => 'meetup_driver',
                ],
            ],
        ],
    ],
];
