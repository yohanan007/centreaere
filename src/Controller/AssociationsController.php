<?php

namespace App\Controller;

use App\Entity\Associations;
use App\Form\AssociationsType;
use App\Repository\AssociationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/associations")
 */
class AssociationsController extends AbstractController
{
    /**
     * @Route("/", name="associations_index", methods={"GET"})
     */
    public function index(AssociationsRepository $associationsRepository): Response
    {
        return $this->render('associations/index.html.twig', [
            'associations' => $associationsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="associations_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $association = new Associations();
        $form = $this->createForm(AssociationsType::class, $association);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($association);
            $entityManager->flush();

            return $this->redirectToRoute('associations_index');
        }

        return $this->render('associations/new.html.twig', [
            'association' => $association,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="associations_show", methods={"GET"})
     */
    public function show(Associations $association): Response
    {
        return $this->render('associations/show.html.twig', [
            'association' => $association,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="associations_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Associations $association): Response
    {
        $form = $this->createForm(AssociationsType::class, $association);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('associations_index', [
                'id' => $association->getId(),
            ]);
        }

        return $this->render('associations/edit.html.twig', [
            'association' => $association,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="associations_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Associations $association): Response
    {
        if ($this->isCsrfTokenValid('delete'.$association->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($association);
            $entityManager->flush();
        }

        return $this->redirectToRoute('associations_index');
    }
}
