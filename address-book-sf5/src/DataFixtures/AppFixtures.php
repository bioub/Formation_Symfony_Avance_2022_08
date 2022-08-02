<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $contact1 = new Contact();
        $contact1->setFirstName('Steve')->setLastName('Jobs')->setEmail('sjobs@apple.com');
        $manager->persist($contact1);

        $contact1 = new Contact();
        $contact1->setFirstName('Bill')->setLastName('Gates')->setTelephone('+1 244 3556 3645');
        $manager->persist($contact1);

        $manager->flush();
    }
}
