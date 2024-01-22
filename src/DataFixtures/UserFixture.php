<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class UserFixture extends Fixture
{
    public function load(ObjectManager $manager, 

    ): void
    {
        $faker = \Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 30; $i++) {
            $user = new User();
            $user->setEmail($faker->email);
            $user->setPassword($faker->password);
            $user->setUsername($faker->userName );
            $user->setAddress($faker->address);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
