<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // если записи с таким логином еще нет
        // $user = new User();
        // $manager->persist($product);
        // $manager->flush();
    }
}
