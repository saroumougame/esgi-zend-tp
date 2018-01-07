<?php

declare(strict_types=1);

namespace Meetup\Controller;

use Meetup\Entity\Meetups;
use Meetup\Form\MeetupsForm;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

final class IndexControllerFactory
{
    public function __invoke(ContainerInterface $container) : IndexController
    {
        $meetupRepository = $container->get(EntityManager::class)->getRepository(Meetups::class);
        $meetupForm = $container->get(MeetupsForm::class);

        return new IndexController($meetupRepository, $meetupForm);
    }
}
