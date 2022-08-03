<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;

class AppFixtures extends Fixture
{
    /** @var Generator */
    protected $faker;

    /**
     * @param Generator $faker
     */
    public function __construct(Generator $faker)
    {
        $this->faker = $faker;
    }


    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        for ($i=1; $i<=10; $i++) {
            $varName = "contact$i";
            $$varName = new Contact();
            $$varName->setFirstName($this->faker->firstName)
                ->setLastName($this->faker->lastName);

            if (mt_rand(0, 1)) {
                $$varName->setEmail($this->faker->email);
            }

            if (mt_rand(0, 1)) {
                $$varName->setTelephone($this->faker->phoneNumber);
            }

            $manager->persist($$varName);
        }

        $manager->flush();
    }
}
