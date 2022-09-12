<?php

namespace Pdk\RgpdBundle\Controller\Admin;

use App\Security\Admin\Voter\User\UserAdminActionVoter;
use Doctrine\ORM\EntityManagerInterface;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GCSAdminController extends CRUDController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function activateAction($id, Request $request): Response
    {
        $gcu = $this->admin->getSubject();

        $gcu->setIsDraft(false);
        $this->em->flush();

        $message = 'La version ' . $gcu->getVersionNumber() . ' a bien été activé et sera mis en place le ';
        $message .= $gcu->getImplementationDate()->format('d/m/Y à H:i:s');
        $this->addFlash('success', $message);

        return $this->redirect($request->headers->get('referer'));
    }
}