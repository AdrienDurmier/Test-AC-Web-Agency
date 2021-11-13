<?php

namespace App\DataFixtures;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Film;

class FilmFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $film1 = new Film();
        $film1->setNom('Le Dernier duel');
        $film1->setImage('img/2639242.jpg');
        $film1->setGenre($this->getReference('genre-historique'));
        $manager->persist($film1);

        $film2 = new Film();
        $film2->setNom('The French Dispatch');
        $film2->setImage('img/4043397.jpg');
        $film2->setGenre($this->getReference('genre-comedie'));
        $manager->persist($film2);

        $film3 = new Film();
        $film3->setNom('Les Eternels');
        $film3->setImage('img/5985249.jpg');
        $film3->setGenre($this->getReference('genre-fantastique'));
        $manager->persist($film3);

        $film4 = new Film();
        $film4->setNom('Le Loup et le lion');
        $film4->setImage('img/3981369.jpg');
        $film4->setGenre($this->getReference('genre-famille'));
        $manager->persist($film4);

        $film5 = new Film();
        $film5->setNom('Illusions Perdues');
        $film5->setImage('img/0523511.jpg');
        $film5->setGenre($this->getReference('genre-drame'));
        $manager->persist($film5);

        $film6 = new Film();
        $film6->setNom('Dune');
        $film6->setImage('img/4633954.jpg');
        $film6->setGenre($this->getReference('genre-sciencefiction'));
        $manager->persist($film6);

        $film7 = new Film();
        $film7->setNom('Eiffel');
        $film7->setImage('img/2153213.jpg');
        $film7->setGenre($this->getReference('genre-historique'));
        $manager->persist($film7);

        $film8 = new Film();
        $film8->setNom('Venom: Let There Be Carnage');
        $film8->setImage('img/0900123.jpg');
        $film8->setGenre($this->getReference('genre-action'));
        $manager->persist($film8);

        $film9 = new Film();
        $film9->setNom('La Fracture');
        $film9->setImage('img/2904334.jpg');
        $film9->setGenre($this->getReference('genre-drame'));
        $manager->persist($film9);

        $film10 = new Film();
        $film10->setNom('Cry Macho');
        $film10->setImage('img/2559362.jpg');
        $film10->setGenre($this->getReference('genre-western'));
        $manager->persist($film10);

        $film11 = new Film();
        $film11->setNom('Aline');
        $film11->setImage('img/1152680.jpg');
        $film11->setGenre($this->getReference('genre-drame'));
        $manager->persist($film11);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            GenreFixtures::class
        );
    }

}
