<?php

namespace App\Controller;

use App\Entity\ParentsAssociations;
use App\Form\ParentsAssociationsType;
use App\Repository\ParentsAssociationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/parents/associations")
 */
class ParentsAssociationsController extends AbstractController
{
    /**
     * @Route("/", name="parents_associations_index", methods={"GET"})
     */
    public function index(ParentsAssociationsRepository $parentsAssociationsRepository): Response
    {
        return $this->render('parents_associations/index.html.twig', [
            'parents_associations' => $parentsAssociationsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="parents_associations_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $parentsAssociation = new ParentsAssociations();
        $form = $this->createForm(ParentsAssociationsType::class, $parentsAssociation, ['user'=>$this->getUser()->getId(),]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($parentsAssociation);
            $entityManager->flush();

            return $this->redirectToRoute('parents_associations_index');
        }

        return $this->render('parents_associations/new.html.twig', [
            'parents_association' => $parentsAssociation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="parents_associations_show", methods={"GET"})
     */
    public function show(ParentsAssociations $parentsAssociation): Response
    {
        return $this->render('parents_associations/show.html.twig', [
            'parents_association' => $parentsAssociation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="parents_associations_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ParentsAssociations $parentsAssociation): Response
    {
        $form = $this->createForm(ParentsAssociationsType::class, $parentsAssociation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('parents_associations_index', [
                'id' => $parentsAssociation->getId(),
            ]);
        }

        return $this->render('parents_associations/edit.html.twig', [
            'parents_association' => $parentsAssociation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="parents_associations_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ParentsAssociations $parentsAssociation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$parentsAssociation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($parentsAssociation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('parents_associations_index');
    }
}
