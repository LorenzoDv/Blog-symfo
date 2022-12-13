<?php

// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        // create 20 products! Bam!
        for ($i = 0; $i < 20; $i++) {
            $post = new Post();
            $post->setTitle($faker->words(rand(3,10), true));
            $post->setAuthor($faker->name());
            $post->setDescription($faker->paragraphs(rand(1,4),true));
            $post->setImage('https://placeimg.com/300/300/tech');
            $manager->persist($post);
        }

        $manager->flush();
    }
}