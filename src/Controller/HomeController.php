<?php

namespace App\Controller;

use App\Repository\AdRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    /**
     * @Route("/hello/{prenom}/age/{age}", name="hello_name_age", requirements={"age" = "\d+"})
     * @Route("/salut", name="hello_base")
     * @Route("/hello/{prenom}", name="hello_name")
     * Shows page saying Bonjour
     * @return void
     */
    public function hello($prenom = "anonyme", $age = 0){
        // return new Response("Bonjour $prenom! Vous avez $age ans." );
        return $this->render('hello.html.twig',
            [
                'prenom' => $prenom,
                'age' => $age
            ]
        );
    }


    /**
     * @Route("/", name="homepage")
     * Shows homepage
     */
    public function home(AdRepository $repo){
       
        $ads = $repo->findAll();
        $adsSelection = [];
        array_push($adsSelection, $ads[1] );
        array_push($adsSelection, $ads[2] );
        array_push($adsSelection, $ads[3] );
        $ads = $adsSelection;

        return $this->render('ad/index.html.twig', [
            'ads' => $ads
        ]);

    }
}

?>