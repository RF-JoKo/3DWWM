<?php

declare(strict_types=1);

namespace App\Controller\Frontend\Account\Address;

use App\Entity\Address;
use App\Form\Frontend\AddressType;
use App\Repository\AddressRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountAddressController extends AbstractController
{
    /**
     * @Route("/compte/adresses", name="app_frontend_account_address_index")
     */
    public function index(): Response
    {
        return $this->render('frontend/account/address/index.html.twig');
    }

    /**
     * @Route("/compte/ajouter-adresse", name="app_frontend_account_address_add")
     */
    public function add(Request $request): Response
    {
        $address = new Address();

        $form = $this->createForm(AddressType::class, $address);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $address->setUser($this->getUser());

            $manager = $this->getDoctrine()
                            ->getManager();

            $manager->persist($address);

            $manager->flush();

            return $this->redirectToRoute('app_frontend_account_address_index');
        }

        return $this->render('frontend/account/address/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/compte/modifier-adresse/{id}", name="app_frontend_account_address_update")
     */
    public function update(Request $request, $id, AddressRepository $addressRepository): Response
    {
        $address = $addressRepository->findOneById($id);

        if(!$address || $address->getUser() != $this->getUser())
        {
            return $this->redirectToRoute('app_frontend_account_address_index');
        }

        $form = $this->createForm(AddressType::class, $address);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()
                            ->getManager();

            $manager->flush();

            return $this->redirectToRoute('app_frontend_account_address_index');
        }

        return $this->render('frontend/account/address/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/compte/supprimer-adresse/{id}", name="app_frontend_account_address_delete")
     */
    public function delete($id, AddressRepository $addressRepository): Response
    {
        $address = $addressRepository->findOneById($id);

        if($address && $address->getUser() == $this->getUser())
        {
            $manager = $this->getDoctrine()
                            ->getManager();

            $manager->remove($address);

            $manager->flush();
        }

        return $this->redirectToRoute('app_frontend_account_address_index');
    }
}
