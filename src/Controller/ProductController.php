<?php

namespace App\Controller;

use App\Form\CountryFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    #[Route('/country', name: 'app_country')]
    public function listCountry(Request $request): Response
    {
        $form = $this->createForm(CountryFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $country = $form->get('country')->getData();
        }

        return $this->render('product/country.html.twig', [
            'form' => $form,
        ]);
    }

}
