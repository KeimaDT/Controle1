<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Categorie;
use App\Entity\Contact;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('FR-fr');
        /* $slugify = new Slugify(); */

            $cat1 = new Categorie();
            $cat2 = new Categorie();
            $cat3 = new Categorie();

            $cat1->setDesignation("amis");
            $cat2->setDesignation("professionnels");
            $cat3->setDesignation("connaissances");

            $manager->persist($cat1);
            $manager->persist($cat2);
            $manager->persist($cat3);

            $cats=[$cat1,$cat2,$cat3];
            

            for($i=0; $i<=21; $i++){
                $contact = new Contact();
                $contact->setNom($faker->lastName)
                        ->setPrenom($faker->lastName)
                        ->setAdresse($faker->streetAddress)
                        ->setPostal(mt_rand(10000,99999))
                        ->setVille($faker->city)
                        ->setNumTel($faker->phoneNumber)
                        ->setMail($faker->email )
                        ->setAvatarImage($faker->imageURL($width=480, $height=480))
                        ->setCategrorie($cats[mt_rand(0,2)]);
                        ;
                        $manager->persist($contact);
            }


        $manager->flush();
    }
}
