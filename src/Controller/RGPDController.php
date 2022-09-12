<?php

namespace Pdk\RgpdBundle\Controller;

use Pdk\RgpdBundle\Repository\GCSRepository;
use Pdk\RgpdBundle\Repository\GCURepository;
use Pdk\RgpdBundle\Repository\PrivacyPolicyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

#[Route(name: 'rgpd__')]
#[AsController]
class RGPDController extends AbstractController
{
    public function __construct(private ParameterBagInterface $parameterBag){}

    #[Route('/politique-de-confidentialite', name: 'privacy_policy', options: ['sitemap' => true], condition: '%pdk_rgpd.privacy_policy.activate% === 1')]
    public function privacyPolicy(PrivacyPolicyRepository $privacyPolicyRepository): Response
    {
        $currentPrivacyPolicy = $privacyPolicyRepository->findCurrentPrivacyPolicy();

        if ($currentPrivacyPolicy === null) throw new NotFoundHttpException();

        return $this->render($this->parameterBag->get('pdk_rgpd.privacy_policy.template'), [
            'privacyPoliticy' => $currentPrivacyPolicy,
            'base' => $this->parameterBag->get('pdk_rgpd.base_template')
        ]);
    }

    #[Route('/conditions-generales-d-utilisation', name: 'gcu', options: ['sitemap' => true], condition: '%pdk_rgpd.gcu.activate% === 1')]
    public function cgu(GCURepository $GCURepository): Response
    {
        $currentCGU = $GCURepository->findCurrentGCU();

        if ($currentCGU === null) throw new NotFoundHttpException();

        return $this->render($this->parameterBag->get('pdk_rgpd.gcu.template'), [
            'gcu' => $currentCGU,
            'base' => $this->parameterBag->get('pdk_rgpd.base_template')
        ]);
    }

    #[Route('/conditions-generales-de-vente', name: 'gcs', options: ['sitemap' => true], condition: '%pdk_rgpd.gcs.activate% === 1')]
    public function cgs(GCSRepository $GCSRepository): Response
    {
        $currentCGS = $GCSRepository->findCurrentGCS();

        if ($currentCGS === null) throw new NotFoundHttpException();

        return $this->render($this->parameterBag->get('pdk_rgpd.gcs.template'), [
            'gcs' => $currentCGS,
            'base' => $this->parameterBag->get('pdk_rgpd.base_template')
        ]);
    }
}