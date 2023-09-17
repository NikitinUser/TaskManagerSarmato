<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $repository = $manager->getRepository(User::class);

        $email = 'admin@mail.ru';
        $password = '$2y$13$aGpyKVf27OBKRym4baLg2OCsrtBV8KM2M7jkTubk5XFhOAV6yN6Cm'; // 12345

        $user = $repository->findOneByEmail($email);

        if (empty($user)) {
            $user = new User();
            $user->setEmail($email)
                ->setRoles([])
                ->setPassword($password);

            $manager->persist($user);
            $manager->flush(); 
        }
    }
}
