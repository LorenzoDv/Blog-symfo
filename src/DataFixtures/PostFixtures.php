<?php

// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

use Faker;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager) : void
    {
        $faker = Faker\Factory::create('fr_FR');
        // create 20 products! Bam!
        for ($i = 0; $i < 10; $i++) {
            $post = new Post();
            $post->setTitle($faker->words(rand(3,10), true));
            $post->setAuthor($faker->name());
            $post->setDescription($faker->paragraphs(rand(1,4),true));
            $post->setImage('https://placeimg.com/300/300/tech');
            $post->setUser($this->getReference('admin' . rand(0,4)));

            for($j = 0; $j < rand(1, 3); $j++) {
                $post->addCategory($this->getReference('category' . rand(0, 4)));
            }
           

            $manager->persist($post);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
            UserFixtures::class
        ];
    }
}
