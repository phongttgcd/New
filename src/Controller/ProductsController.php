<?php

namespace App\Controller;

use App\Entity\Products;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    #[Route('/products', name: 'products')]
    public function index(): Response
    {
        return $this->render('products/index.html.twig', [
            'controller_name' => 'ProductsController',
        ]);
    }
    #[Route('/products/all/ascending', name: 'products_ascending')]
    public function productsAscending()
    {
        // Call Entity Manager
        $em = $this
            ->getDoctrine()
            ->getManager();

        // Call CustomerRepo
        $productRepo = $em->getRepository(Products::class);

        // Call function
        $result = $productRepo->getProductsAscending();

        // Return result to View
        return $this->render('products/index.html.twig', [
            'products' => $result
        ]);
    }
    #[Route('/products/details/{id}', name: 'products_details')]
    public function detailsAction($id)
    {
        $products = $this->getDoctrine()
            ->getRepository('App:Products')
            ->find($id);
        return $this->render('products/details.html.twig', [
            'products' => $products
        ]);
    }

}