<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Entity\Image;
use App\Form\AdType;
use App\Repository\AdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function create( Request $request, EntityManagerInterface $manager){

        $ad = new Ad();

        $image = new Image();

        $image->setUrl('http://placehold.it/400x200')
        ->setCaption('Titre 1');
        $image2 = new Image();

        $image->setUrl('http://placehold.it/400x200')
        ->setCaption('Titre 2');

        $ad->addImage($image)
            ->addImage($image2);

        $form = $this->createForm(AdType::class, $ad);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
        
            $manager->persist($ad);
            $manager->flush();

            $this->addFlash(
                "success",
                "L'annonce <strong>{$ad->getTitle()}</strong> a bien été enregristrée !"
            );

            return $this->redirectToRoute('ads_show', [
                'slug' => $ad->getSlug()
            ]);
        }

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
