<?php

declare(strict_types=1);

namespace Meetup\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\Date;
use Zend\Validator\StringLength;
use Zend\Validator\Callback;
use Zend\Form\Element\DateTime;

class MeetupsForm extends Form implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('meetup');

        $this->add([
            'type' => Element\Text::class,
            'name' => 'title',
            'options' => [
                'label' => 'Title',
            ],
            'attributes' => [
                'class' => 'form-control',
            ],
        ]);
        $this->add([
            'type' => Element\Text::class,
            'name' => 'description',
            'options' => [
                'label' => 'Description',
            ],
            'attributes' => [
                'class' => 'form-control',
            ],
        ]);
        $this->add([
            'type' => Element\Text::class,
            'name' => 'date_debut',
            'options' => [
                'label' => 'Date debut',
            ],
            'attributes' => [
                'class' => 'form-control',
            ],
        ]);
        $this->add([
            'type' => Element\Text::class,
            'name' => 'date_fin',
            'options' => [
                'label' => 'Description',
            ],
            'attributes' => [
                'class' => 'form-control',
            ],
        ]);

        $this->add([
            'type' => Element\Submit::class,
            'name' => 'submit',
            'attributes' => [
                'value' => 'Submit',
                'class' => 'btn btn-primary',
            ],
        ]);

    }

    public function getInputFilterSpecification()
    {
        return [
            'title' => [
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'min' => 2,
                            'max' => 4,
                        ],
                    ],
                ],
            ],
            'description' => [
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => 10,
                        ],
                    ],
                ],
            ],
            'date_debut' => [
                'validators' => [
                    [
                        'name' => Date::class,
                        'options' => [
                            'min' => 10,
                            'max' => 10,
                        ],
                    ],
                ],
            ],
            'date_fin' => [
                'validators' => [
                    [
                        'name' => Callback::class,
                        'options' => [
                            'callback' => function ($value, $context = []) {
                                $startDate = new DateTime($context['date_debut'] ?? null);
                                $endDate = new DateTime($value);

                                return $startDate < $endDate;
                            },
                            'messages' => [
                                Callback::INVALID_VALUE => '%value% La date de fin est inferieur a la date de debut',
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}
