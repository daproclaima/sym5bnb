<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('Fr-fr');
        for($i = 1; $i <=30; $i++ ){

            $ad = new Ad();

            $title = $faker->sentence();
            $coverImage = $faker->imageUrl(1000, 350);
            $introduction = $faker->paragraph(2);
            $content = '<p>'. join('</p><p>', $faker->paragraph(5)) . '</p>';
            

            $ad->setTitle("Titre de l'annonce n.$i")
            ->setSlug('titre-de-l-annonce n.$i')
            ->setCoverImage('http://placehold.it/1000x300')
            ->setIntroduction("Bonjour à tous c'est une introduction")
            ->setContent("<p>Je suis un contenu riche !</p>")
            ->setPrice(mt_rand(40, 200))
            ->setRooms(mt_rand(1,5));
            
            // save the content 
            $manager->persist($ad);

        }
        // execute only once the query with the whole saved content
        $manager->flush();
    }
}
