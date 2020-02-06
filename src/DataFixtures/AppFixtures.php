<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use App\Entity\Image;
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
            $content = '<p>'. join('</p><p>', $faker->paragraphs(5)) . '</p>';
            

            $ad->setTitle($title)
                ->setCoverImage($coverImage)
                ->setIntroduction($introduction)
                ->setContent($content)
                ->setPrice(mt_rand(40, 200))
                ->setRooms(mt_rand(1,5));
            
            // save the content 
            $manager->persist($ad);


            for($j = 0; $j <= mt_rand(2,5); $j++) {
                $image = new Image();
                $image->setUrl($faker->imageUrl())
                    ->setCaption($faker->sentence())->setAd($ad);

                $manager->persist($image);
            }

        }
        // execute only once the query with the whole saved content
        $manager->flush();

        // php bin/console doctrine:fixtures:load  [--append]
    }
}
