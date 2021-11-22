<?php

namespace App\Controller\Frontend;

use App\Form\Frontend\ModifyPasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AccountController extends AbstractController
{
    /**
     * @Route("/compte", name="app_frontend_account_index")
     */
    public function index(): Response
    {
        return $this->render('frontend/account/index.html.twig');
    }

    /**
     * @Route("/compte/modifier-mot-de-passe", name="app_frontend_account_modifyPassword")
     */
    public function modifyPassword(Request $request, UserPasswordHasherInterface $crypter): Response
    {
        $notification = null;

        $user = $this->getUser();

        $form = $this->createForm(ModifyPasswordType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $current_pwd = $form->get('current_password')->getData();

            if($crypter->isPasswordValid($user, $current_pwd))
            {
                $new_pwd = $form->get('new_password')->getData();

                $password = $crypter->hashPassword($user, $new_pwd);

                $user->setPassword($password);

                $manager = $this->getDoctrine()->getManager();

                $manager->flush();

                $notification = "Mot de passe modifié avec succès !";
            }
            else
            {
                $notification = "Mot de passe actuel invalide.";
            }
        }

        return $this->render('frontend/account/modifyPassword.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }
}
