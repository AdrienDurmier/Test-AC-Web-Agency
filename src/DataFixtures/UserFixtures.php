<?php

namespace App\DataFixtures;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('j.doe@allocinoche.com');
        $user->setFirstname('John');
        $user->setLastname('Doe');
        $user->addRole('ROLE_ADMIN');
        $user->setPassword($this->encoder->encodePassword($user, 'test'));
        $manager->persist($user);

        $user = new User();
        $user->setEmail('noel.flantier@oss.fr');
        $user->setFirstname('Noel');
        $user->setLastname('Flantier');
        $user->addRole('ROLE_USER');
        $user->setPassword($this->encoder->encodePassword($user, 'test'));
        $manager->persist($user);

        $manager->flush();
    }

}
