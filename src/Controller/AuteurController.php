<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Entity\User;
use App\Form\AuteurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AuteurController extends AbstractController
{
    /**
     * @Route("/auteur", name="auteur")
     */
    public function index(): Response
    {

        return $this->render('auteur/index.html.twig', [
            'controller_name' => 'AuteurController',
        ]);
    }

    /**
     * @Route("/auteur-create", name="create_auteur")
     *
     */
    public function createAuteur(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder): Response
    {
        $auteur = new Auteur();
        $form = $this->createForm(AuteurType::class, $auteur);
        $error = false;

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            //###Creer un nouveau utilisateur pour l'auteur ###//
            $userName = $auteur->getNom();
            $verif = $manager->getRepository(User::class)->findOneBy(['username'=>$userName]);
            if (!empty($verif)){
                $error = true;
            }else{
                $user = new User();
                $user->setRoles(['ROLE_USER'])
                    ->setPassword($encoder->encodePassword($user, "pass"))
                    ->setUsername($userName);
                $manager->persist($user);

                //###Insertion auteur##//
                $manager->persist($auteur);
                $manager->flush();

                $this->manualLogUser($user);
            }

            return $this->render('auteur/create.html.twig', [
                'form' => $form->createView(),
                'error' => $error
            ]);
        }

        return $this->render('auteur/create.html.twig', [
            'form' => $form->createView(),
            'error' => $error
        ]);
    }

    /**
     * @param User $user
     */
    public function manualLogUser(User $user){
        // Here, "main" is the name of the firewall in your security.yml
        // Manually authenticate user in controller
        $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
        $this->get('security.token_storage')->setToken($token);
        $this->get('session')->set('_security_main', serialize($token));
    }

    /**
     * @Route("/auteur/{id}", name="delete_auteur")
     */
    public function deleteAuteur(): Response
    {

        return $this->render('auteur/delete.html.twig', [

        ]);
    }
}
