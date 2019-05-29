<?php

namespace App\Controller;

use App\Entity\Journaliers;
use App\Form\JournaliersType;
use App\Repository\JournaliersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/journaliers")
 */
class JournaliersController extends AbstractController
{
    /**
     * @Route("/", name="journaliers_index", methods={"GET"})
     */
    public function index(JournaliersRepository $journaliersRepository): Response
    {
        return $this->render('journaliers/index.html.twig', [
            'journaliers' => $journaliersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="journaliers_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $journalier = new Journaliers();
        $form = $this->createForm(JournaliersType::class, $journalier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($journalier);
            $entityManager->flush();

            return $this->redirectToRoute('journaliers_index');
        }

        return $this->render('journaliers/new.html.twig', [
            'journalier' => $journalier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="journaliers_show", methods={"GET"})
     */
    public function show(Journaliers $journalier): Response
    {
        return $this->render('journaliers/show.html.twig', [
            'journalier' => $journalier,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="journaliers_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Journaliers $journalier): Response
    {
        $form = $this->createForm(JournaliersType::class, $journalier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('journaliers_index', [
                'id' => $journalier->getId(),
            ]);
        }

        return $this->render('journaliers/edit.html.twig', [
            'journalier' => $journalier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="journaliers_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Journaliers $journalier): Response
    {
        if ($this->isCsrfTokenValid('delete'.$journalier->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($journalier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('journaliers_index');
    }
}
