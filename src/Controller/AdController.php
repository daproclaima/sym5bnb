<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Repository\AdRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;

class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ads_index")
     * php bin/console debug:autowiring --all is a core command
     */
    public function index(AdRepository $repo)
    {
        $ads = $repo->findAll();

        return $this->render('ad/index.html.twig', [
            'ads' => $ads
        ]);
    }

    /**
     * Creates an ad
     *
     * @Route("/ads/new",name="ads_create")
     * 
     * @return Response
     */
    public function create(){

        $ad = new Ad();

        $form = $this->createFormBuilder($ad)
            ->add('title')
            ->add('introduction')
            ->add('content')
            ->add('rooms')
            ->add('price')
            ->add('coverImage')
            ->getForm();

        return $this->render('ad/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Shows one ad
     *
     * @Route("/ads/{slug}", name="ads_show")
     * 
     * @return Response
     */
    public function show( Ad $ad) {
        return $this->render('ad/show.html.twig', [
            'ad'=> $ad
        ]);
    }
}
