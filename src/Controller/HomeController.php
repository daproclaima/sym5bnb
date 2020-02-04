<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController {

    /**
     * @Route("/", name="homepage")
     */
    public function home(){
        return new Response("
            <html>
                <head>
                    <title> Mon application Smfony 5 Rbnb</title>    
                </head>
                <body>
                    <h1>Bonjour à tous</h1>
                    <p> Nous y voilà!</p>
        "); 
    }
}

?>