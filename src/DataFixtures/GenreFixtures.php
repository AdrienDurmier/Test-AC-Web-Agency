<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Genre;

class GenreFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $genre1 = new Genre();
        $genre1->setNom('Science Fiction');
        $manager->persist($genre1);
        $this->addReference('genre-sciencefiction', $genre1);

        $genre2 = new Genre();
        $genre2->setNom('Action');
        $manager->persist($genre2);
        $this->addReference('genre-action', $genre2);

        $genre3 = new Genre();
        $genre3->setNom('Fantastique');
        $manager->persist($genre3);
        $this->addReference('genre-fantastique', $genre3);

        $genre4 = new Genre();
        $genre4->setNom('Comédie');
        $manager->persist($genre4);
        $this->addReference('genre-comedie', $genre4);

        $genre5 = new Genre();
        $genre5->setNom('Animation');
        $manager->persist($genre5);
        $this->addReference('genre-animation', $genre5);

        $genre6 = new Genre();
        $genre6->setNom('Drame');
        $manager->persist($genre6);
        $this->addReference('genre-drame', $genre6);

        $genre7 = new Genre();
        $genre7->setNom('Famille');
        $manager->persist($genre7);
        $this->addReference('genre-famille', $genre7);

        $genre8 = new Genre();
        $genre8->setNom('Guerre');
        $manager->persist($genre8);
        $this->addReference('genre-guerre', $genre8);

        $genre9 = new Genre();
        $genre9->setNom('Historique');
        $manager->persist($genre9);
        $this->addReference('genre-historique', $genre9);

        $genre10 = new Genre();
        $genre10->setNom('Péplum');
        $manager->persist($genre10);
        $this->addReference('genre-peplum', $genre10);

        $genre11 = new Genre();
        $genre11->setNom('Western');
        $manager->persist($genre11);
        $this->addReference('genre-western', $genre11);

        $manager->flush();
    }

}
