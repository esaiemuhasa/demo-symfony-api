<?php

namespace App\DataFixtures;

use App\Entity\News;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class NewsFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_FR");
        $now = new DateTimeImmutable();

        $user = new User();
        $user
            ->setNames('Esaie Muhasa')
            ->setEmail('esaiemuhasa.dev@gmail.com')
            ->setRecordingDate($now)
            ->setPassword($this->passwordHasher->hashPassword($user, '12345'))
            ->setRoles(['USER_ROLE', 'ADMIN_ROLE']);

        $manager->persist($user);

        for ($i=0; $i < 100; $i++) { 
            $news  = new News();

            $news
                ->setRecordingDate($now)
                ->setAuthor($user)
                ->setTitle($faker->words(6, true))
                ->setKeywords(implode(',', $faker->words(5)))
                ->setContent($faker->words(500, true));

            $manager->persist($news);
        }

        $manager->flush();
    }
}
