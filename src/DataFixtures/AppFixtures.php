<?php

namespace App\DataFixtures;


use App\Entity\User;
use App\Entity\Administrateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{


    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
       
        $user = new User();
        $user->setEmail("yohanan_h@yahoo.fr");
        $user->setRoles(["ROLE_SUPER_ADMIN"]);
        $user->setPassword($this->encoder->encodePassword(
            $user,
            "23101981"
        ));



        $administateur = new Administrateur();
        $administateur->setNomAdministrateur("HIRSCH");
        $administateur->setPrenomAdministrateur("YOHANAN");
        $administateur->setTelephone("0388603469");
        $administateur->setDateDeNaissanceAdministrateur(NULL);
        $administateur->setAdresseAdministrateur("18 rue stockholm");
        $administateur->setVilleAdministrateur("Strasbourg");
        $administateur->setPaysAdministrateur("France");

        $administateur->setUsers($user);


        $manager->persist($administateur);
        $manager->flush();
    }
}
