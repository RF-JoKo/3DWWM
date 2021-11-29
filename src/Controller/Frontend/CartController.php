<?php

namespace App\Controller\Frontend;

use App\Class\Cart;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    /**
     * @Route("/panier", name="app_frontend_cart_index")
     */
    public function index(Cart $cart, ProductRepository $productRepository): Response
    {
        $total = [];

        foreach($cart->get() as $id =>$quantity)
        {
            $total[] = [
                'product' => $productRepository->findOneById($id),
                'quantity' => $quantity
            ];
        }

        return $this->render('frontend/cart/index.html.twig', [
            'cart' => $total
        ]);
    }

    /**
     * @Route("/cart/add/{id}", name="app_frontend_cart_add")
     */
    public function add(Cart $cart, $id): Response
    {
        $cart->add($id);

        return $this->redirectToRoute('app_frontend_cart_index');
    }

    /**
     * @Route("/cart/remove", name="app_frontend_cart_remove")
     */
    public function remove(Cart $cart): Response
    {
        $cart->remove();

        return $this->redirectToRoute('app_frontend_product_index');
    }
}
