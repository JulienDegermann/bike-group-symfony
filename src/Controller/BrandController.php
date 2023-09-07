<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Brand;
use App\Repository\BrandRepository;
use App\Form\BrandType;
// use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class BrandController extends AbstractController
{
    #[Route('/brand', name: 'show_brands')]
    public function index(BrandRepository $repo): Response
    {
        return $this->render('brand/index.html.twig', [
            'controller_name' => 'BrandController',
            'brands' => $repo->findAll(),
        ]);
    }

    #[Route('/brand/{id}', name: 'show_brand', methods: ['GET'])]
    public function show(Brand $brand): Response
    {
        return $this->render('brand/show.html.twig', [
            'controller_name' => 'BrandController',
            'brand' => $brand,
        ]);
    }

    #[Route('/brand/create', name: 'create_brand', methods: ['GET', 'POST'], priority: 10)]
    public function create(Request $request, BrandRepository $repo): Response
    {
        $brand = new Brand();
        $form = $this->createForm(BrandType::class, $brand);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $repo->save($brand, true);
            return $this->redirectToRoute('show_brands');
        }
        return $this->render('brand/create.html.twig', [
            'controller_name' => 'BrandController',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/brand/{id}/edit', name: 'edit_brand', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function edit(BrandRepository $repo, Brand $brand, Request $request): Response
    {
        $form = $this->createForm(BrandType::class, $brand);
        if ($brand === null) {
            dd('hello');
        }
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $repo->save($brand, true); 
            return $this->redirectToRoute('show_brands');
        }
        return $this->render('brand/edit.html.twig', [
            'controller_name' => 'BrandController',
            'form' => $form->createView(),
            'brand' => $brand,
        ]);
    }

    #[Route('/brand/{id}/delete', name: 'delete_brand', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function delete(Brand $brand, BrandRepository $repo): Response
    {
        $repo->delete($brand, true);
        return $this->redirectToRoute('show_brands');
    }
}
