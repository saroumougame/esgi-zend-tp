<?php

declare(strict_types=1);

namespace Meetup\Controller;

use Meetup\Entity\Meetups;
use Meetup\Repository\MeetupsRepository;
use Meetup\Form\MeetupsForm;
use Zend\Http\PhpEnvironment\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

final class IndexController extends AbstractActionController
{
    /**
     * @var MeetupsRepository
     */
    private $meetupRepository;

    /**
     * @var MeetupsForm
     */
    private $meetupForm;

    public function __construct(MeetupsRepository $meetupRepository, MeetupsForm $meetupForm)
    {
        $this->meetupRepository = $meetupRepository;
        $this->meetupForm = $meetupForm;
    }

    public function indexAction()
    {
        return new ViewModel([
            'meetups' => $this->meetupRepository->findAll(),
        ]);
    }

    public function addAction()
    {
        $form = $this->meetupForm;
        $msg = '';
        /* @var $request Request */
       $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $meetup = $this->meetupRepository->createMeetupsFromNameAndDescription(
                    $form->getData()['title'],
                    $form->getData()['description'] ?? '',
                    $form->getData()['date_debut'] ?? '',
                    $form->getData()['date_fin'] ?? ''
                );

              $this->meetupRepository->add($meetup);
              return $this->redirect()->toRoute('meetups');

            }
        }


        $form->prepare();

        return new ViewModel([
            'form' => $form,
            'msg' => $msg,
        ]);
    }

    public function deleteAction()
    {
        $params = $this->params('id');

        $this->meetupRepository->delete($params);
        return $this->redirect()->toRoute('meetups');

    }

    public function editAction()
    {


        $form = $this->meetupForm;

        /* @var $request Request */
        $request = $this->getRequest();
        $paramId = $this->params('id');
        $msg = '';

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $meetup = $this->meetupRepository->createMeetupsFromNameAndDescription(
                    $form->getData()['title'],
                    $form->getData()['description'] ?? '',
                    $form->getData()['date_debut'] ?? '',
                    $form->getData()['date_fin'] ?? ''
                );

                    $this->meetupRepository->edit($paramId, $meetup);
                    return $this->redirect()->toRoute('meetups');

            }
        } else {
            $meetup = $this->meetupRepository->find($paramId);
            $form->setData($meetup->getArrayCopy());
        }


        $form->prepare();

        return new ViewModel([
            'form' => $form,
            'msg' => $msg,
        ]);


    }

    public function showAction()
    {
        $id = $this->params('id');

        return new ViewModel([
            'meetup' => $this->meetupRepository->find($id),
        ]);

    }



}
