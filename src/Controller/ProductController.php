<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\Product;
use App\Form\ProductCreateType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="app_product")
     */
    public function index(): Response
    {

        $em = $this->getDoctrine()->getManager();

        $product = $em->getRepository(Product::class)->findAll();

//        $company = $em->getRepository(Company::class)->find(1);
        $products =  $em->getRepository(Product::class)->createQueryBuilder('p')
//            ->Where('p.company = :Company')
//            ->setParameter('Company', $company)
            ->getQuery()
            ->getResult();

        foreach ($products as $product){

            dump($product->getCompany());
        }
        die;
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
            'products' => $product,
            'Name' => "Usman Ali"
        ]);
    }

    /**
     * @Route("/product/create", name="app_product_create",methods={"GET", "POST"}))
     */
    public function create(Request $request): Response
    {

        $em = $this->getDoctrine()->getManager();
        $product = new Product();

        $form = $this->createForm(ProductCreateType::class, $product,['method' => 'post']);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em->persist($product);

           $em->flush();

           return $this->redirectToRoute('app_product');

        }

        return $this->render('product/create.html.twig', [
            'controller_name' => 'ProductController',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/product/{id}/update", name="app_product_update")
     * @return Response
     */
    public function update(int $id, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();

        $product = $em->getRepository(Product::class)->find($id);

        $form = $this->createForm(ProductCreateType::class, $product,['method' => 'post']);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em->persist($product);

            $em->flush();

            return $this->redirectToRoute('app_product');

        }

        return $this->render('product/create.html.twig', [
            'controller_name' => 'ProductController',
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/product/{id}/delete", name="app_product_delete")
     */
    public function delete(int $id): Response
    {

        $em = $this->getDoctrine()->getManager();

        $product = $em->getRepository(Product::class)->find($id);

        if ($product){

            $em->remove($product);
            $em->flush();
            return $this->redirectToRoute('app_product');
        }


        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }
}
