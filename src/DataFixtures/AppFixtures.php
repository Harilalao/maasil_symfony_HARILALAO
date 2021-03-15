<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Auteur;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;
    private $tools;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        //### Creation d'un nouveau utilisateur mote de pass 'pass'###//
        $user = new User();
        $user->setPassword($this->encoder->encodePassword($user, "pass"))
            ->setRoles(['ROLE_USER'])
            ->setUsername('admin@lithis.com');
        $manager->persist($user);

        $auteur = new Auteur();
        $auteur->setNom("Harilalao M.");
        $manager->persist($auteur);

        $auteur1 = new Auteur();
        $auteur1->setNom("Patrick Casa");
        $manager->persist($auteur1);

        $auteur2 = new Auteur();
        $auteur2->setNom("Pierre Monreau");
        $manager->persist($auteur2);

        $article = new Article();
        $article->setAuteur($auteur)
            ->setTitre("L'homme doit explorer, et c'est l'exploration à son apogée")
            ->setTexte("Jamais dans toute leur histoire les hommes n'ont pu vraiment concevoir le monde comme un: une seule sphère, un globe, ayant les qualités d'un globe, une terre ronde dans laquelle toutes les directions se rejoignent finalement, dans laquelle il n'y a pas de centre parce que chaque point, ou aucun, est centre - une terre égale que tous les hommes occupent comme égaux. La terre de l'aviateur, si les hommes libres y parviennent, sera vraiment ronde: un globe en pratique, pas en théorie");
        $manager->persist($article);

        $article2 = new Article();
        $article2->setAuteur($auteur)
            ->setTitre("La science et ses avantages")
            ->setTexte("La science coupe de deux manières, bien sûr; ses produits peuvent être utilisés à la fois pour le bien et le mal. Mais il n'y a pas de retour en arrière par rapport à la science. Les premiers avertissements sur les dangers technologiques proviennent également de la science");
        $manager->persist($article2);

        $article3 = new Article();
        $article3->setAuteur($auteur)
            ->setTitre("La science et ses avantages 3")
            ->setTexte("La science coupe de deux manières, bien sûr; ses produits peuvent être utilisés à la fois pour le bien et le mal. Mais il n'y a pas de retour en arrière par rapport à la science. Les premiers avertissements sur les dangers technologiques proviennent également de la science");
        $manager->persist($article3);

        $article4 = new Article();
        $article4->setAuteur($auteur2)
            ->setTitre("La science et ses avantages 4")
            ->setTexte("La science coupe de deux manières, bien sûr; ses produits peuvent être utilisés à la fois pour le bien et le mal. Mais il n'y a pas de retour en arrière par rapport à la science. Les premiers avertissements sur les dangers technologiques proviennent également de la science");
        $manager->persist($article4);

        $article5 = new Article();
        $article5->setAuteur($auteur2)
            ->setTitre("La science et ses avantages 5")
            ->setTexte("La science coupe de deux manières, bien sûr; ses produits peuvent être utilisés à la fois pour le bien et le mal. Mais il n'y a pas de retour en arrière par rapport à la science. Les premiers avertissements sur les dangers technologiques proviennent également de la science");
        $manager->persist($article5);





        $manager->flush();
    }
}
