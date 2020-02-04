<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    /**
     * @Route("/hello/{prenom}/age/{age}", name="hello", requirements={"age" = "\d+"})
     * @Route("/hello")
     * @Route("/hello/{prenom}")
     * Shows page saying Bonjour
     * @return void
     */
    public function hello($prenom = "anonyme", $age = 0){
        return new Response("Bonjour $prenom! Vous avez $age ans." );
    }


    /**
     * @Route("/", name="homepage")
     * Shows homepage
     */
    public function home(){

        $prenoms = ["Lior"=> 31, "Philippe"=> 31, "Auguste"=>22, "Sébastien"=>25];


        return $this->render(
            'home.html.twig', 
            [
                'title'=>"Bonsoir à tous",
                'age'=> 14,
                'tableau'=> $prenoms
            ]
        );
    }
}

?>