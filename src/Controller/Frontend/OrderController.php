<?php

namespace App\Controller\Frontend;

use App\DTO\Cart;
use App\Form\Frontend\OrderType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{
    /**
     * @Route("/commande", name="app_frontend_order_index")
     */
    public function index(Cart $cart, Request $request): Response
    {
        if(!$this->getUser()->getAddresses()->getValues())
        {
            return $this->redirectToRoute('app_frontend_account_address_add');
        }

        $form = $this->createForm(OrderType::class, null, [
            'user' => $this->getUser()
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            dd($form->getData());
        }

        return $this->render('frontend/order/index.html.twig', [
            'form' => $form->createView(),
            'cart' => $cart->getFull()
        ]);
    }
}
