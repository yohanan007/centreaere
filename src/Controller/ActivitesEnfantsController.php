<?php

namespace App\Controller;

use App\Entity\ActivitesEnfants;
use App\Form\ActivitesEnfantsType;
use App\Repository\ActivitesEnfantsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/activites/enfants")
 */
class ActivitesEnfantsController extends AbstractController
{
    /**
     * @Route("/", name="activites_enfants_index", methods={"GET"})
     */
    public function index(ActivitesEnfantsRepository $activitesEnfantsRepository): Response
    {
        return $this->render('activites_enfants/index.html.twig', [
            'activites_enfants' => $activitesEnfantsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="activites_enfants_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $activitesEnfant = new ActivitesEnfants();
        $form = $this->createForm(ActivitesEnfantsType::class, $activitesEnfant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($activitesEnfant);
            $entityManager->flush();

            return $this->redirectToRoute('activites_enfants_index');
        }

        return $this->render('activites_enfants/new.html.twig', [
            'activites_enfant' => $activitesEnfant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="activites_enfants_show", methods={"GET"})
     */
    public function show(ActivitesEnfants $activitesEnfant): Response
    {
        return $this->render('activites_enfants/show.html.twig', [
            'activites_enfant' => $activitesEnfant,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="activites_enfants_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ActivitesEnfants $activitesEnfant): Response
    {
        $form = $this->createForm(ActivitesEnfantsType::class, $activitesEnfant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('activites_enfants_index', [
                'id' => $activitesEnfant->getId(),
            ]);
        }

        return $this->render('activites_enfants/edit.html.twig', [
            'activites_enfant' => $activitesEnfant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="activites_enfants_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ActivitesEnfants $activitesEnfant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$activitesEnfant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($activitesEnfant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('activites_enfants_index');
    }
}
