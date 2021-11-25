<?php

namespace App\Controller\Frontend;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    /**
     * @Route("/nos-modeles", name="app_frontend_product_index")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()
                           ->getRepository(Product::class);

        $products = $repository->findAll();

        return $this->render('frontend/product/index.html.twig', [
            'products' => $products
        ]);
    }

    /**
     * @Route("/modele/{slug}", name="app_frontend_product_display")
     */
    public function display(Product $product): Response
    {
        return $this->render('frontend/product/display.html.twig', [
            'product' => $product
        ]);
    }
}
