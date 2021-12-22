<?php

namespace App\Controller\Frontend\Account;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountController extends AbstractController
{
    /**
     * @Route("/mon-compte", name="app_frontend_account_index")
     */
    public function index(): Response
    {
        return $this->render('frontend/account/index.html.twig');
    }
}
