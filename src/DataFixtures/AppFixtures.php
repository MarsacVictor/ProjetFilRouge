<?php

namespace App\DataFixtures;

use App\Entity\Acheteur;
use App\Entity\Realisation;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher){
        $this->userPasswordHasher = $userPasswordHasher;
    }
    public function load(ObjectManager $manager): void
    {

        $realisation = new Realisation();
        $realisation->setImageRealisation('366491801-1442208319655735-3676106355701406099-n-64f88a6647404.jpg');
        $realisation->setVendu(true);
        $realisation->setAchetable(false);
        $realisation->setNom('Dans l\'eau');
        $realisation->setPrix(10);
        $realisation->setDescription('Jeune femme dans l\'eau');
        $realisation->setType('Dessin');
        $manager->persist($realisation);

        $realisation2 = new Realisation();
        $realisation2->setImageRealisation('baleine-64faf4db9efa4.jpg');
        $realisation2->setVendu(false);
        $realisation2->setAchetable(true);
        $realisation2->setNom('Baleine volante');
        $realisation2->setPrix(10);
        $realisation2->setDescription('Baleine volante');
        $realisation2->setType('Dessin');
        $manager->persist($realisation2);

        $realisation3 = new Realisation();
        $realisation3->setImageRealisation('demon-64faf51522b38.jpg');
        $realisation3->setVendu(false);
        $realisation3->setAchetable(true);
        $realisation3->setNom('Demon');
        $realisation3->setPrix(10);
        $realisation3->setDescription('Croquis de demon');
        $realisation3->setType('Dessin');
        $manager->persist($realisation3);

        $realisation4 = new Realisation();
        $realisation4->setImageRealisation('Fille-nuage-64faf574dd158.jpg');
        $realisation4->setVendu(false);
        $realisation4->setAchetable(true);
        $realisation4->setNom('Femme dans les nuages');
        $realisation4->setPrix(10);
        $realisation4->setDescription('Jeune femme dans les nuages');
        $realisation4->setType('Dessin');
        $manager->persist($realisation4);

        $user = new User();
        $user->setNom('Admin');
        $user->setPrenom('Test');
        $user->setEmail('admin@admin.com');
        $user->setPassword(
            $this->userPasswordHasher->hashPassword(
                $user,
                'azertyui'
            )
        );
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        $acheteur = new Acheteur();
        $acheteur->setNom('Marsac');
        $acheteur->setAdresse('17 rue');
        $acheteur->setMail('victor@gmail.com');
        $acheteur->setRealisation($realisation);
        $manager->persist($acheteur);

        $manager->flush();
    }
}
