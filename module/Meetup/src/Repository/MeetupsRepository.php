<?php

declare(strict_types=1);

namespace Meetup\Repository;

use Meetup\Entity\Meetups;
use Doctrine\ORM\EntityRepository;
use Meetup\Model\MeetupModel;

final class MeetupsRepository extends EntityRepository
{

    public function add($meetup) : void
    {

        $this->getEntityManager()->persist($meetup);
        $this->getEntityManager()->flush($meetup);
    }

    public function createMeetupsFromNameAndDescription(string $name, string $description, string $date_debut,string $date_fin)
    {
        return new Meetups($name, $description, $date_debut, $date_fin);
    }

    public function delete($id)
    {
        $em = $this->getEntityManager();
        $entity = $em->getRepository(Meetups::class)->find($id);
        $em->remove($entity);
        $em->flush();

    }

    public function edit($id, $meetup)
    {
        $em = $this->getEntityManager();
        $entity = $em->getRepository(Meetups::class)->find($id);
        $entity->exchangeArray($meetup->getArrayCopy());
        $em->merge($entity);
        $em->flush();

    }




}
