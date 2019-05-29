<?php

namespace App\Controller;

use App\Entity\TypeActivites;
use App\Form\TypeActivitesType;
use App\Repository\TypeActivitesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type/activites")
 * @
 */
class TypeActivitesController extends AbstractController
{
    /**
     * @Route("/", name="type_activites_index", methods={"GET"})
     */
    public function index(TypeActivitesRepository $typeActivitesRepository): Response
    {
        return $this->render('type_activites/index.html.twig', [
            'type_activites' => $typeActivitesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="type_activites_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeActivite = new TypeActivites();
        $form = $this->createForm(TypeActivitesType::class, $typeActivite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeActivite);
            $entityManager->flush();

            return $this->redirectToRoute('type_activites_index');
        }

        return $this->render('type_activites/new.html.twig', [
            'type_activite' => $typeActivite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_activites_show", methods={"GET"})
     */
    public function show(TypeActivites $typeActivite): Response
    {
        return $this->render('type_activites/show.html.twig', [
            'type_activite' => $typeActivite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_activites_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeActivites $typeActivite): Response
    {
        $form = $this->createForm(TypeActivitesType::class, $typeActivite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_activites_index', [
                'id' => $typeActivite->getId(),
            ]);
        }

        return $this->render('type_activites/edit.html.twig', [
            'type_activite' => $typeActivite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_activites_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypeActivites $typeActivite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeActivite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeActivite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_activites_index');
    }
}
