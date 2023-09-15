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

        $login = 'admin';
        $password = '$2y$13$aGpyKVf27OBKRym4baLg2OCsrtBV8KM2M7jkTubk5XFhOAV6yN6Cm'; // 12345

        $user = $repository->findOneByLogin($login);

        if (empty($user)) {
            $user = new User();
            $user->setLogin($login)
                ->setPassword($password);

            $repository->create($user);
        }
    }
}
