<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker;


class UserFixtures extends Fixture
{

    private $hasher;
 
    public function __construct(UserPasswordHasherInterface $hasher)
    {

        $this->hasher = $hasher;

    }
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for($i = 0 ; $i<5; $i++){
              $user = new User();
              $username = $faker->userName();
              $user->setUsername($username)
              ->setEmail($username . '@blog.fr')
              ->setPassword($this->hasher->hashPassWord($user, 'password'))
              ->setRoles(['ROLE_USER']);
              $this->addReference('user'. $i, $user);
                $manager->persist($user);
        }
        for($i = 0 ; $i<5; $i++){
            $user = new User();
            $admin = $faker->userName();
            $user->setUsername($admin)
            ->setEmail($admin . '@blog.fr')
            ->setPassword($this->hasher->hashPassWord($user, 'password'))
            ->setRoles(['ROLE_USER, ROLE_ADMIN']);

            $this->addReference('admin'. $i, $user);
            
            
            $manager->persist($user);
      }

        $manager->flush();
    }
}
