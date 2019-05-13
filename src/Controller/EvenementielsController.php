<?php

namespace App\Controller;

use App\Entity\Evenementiels;
use App\Form\EvenementielsType;
use App\Repository\EvenementielsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/evenementiels")
 */
class EvenementielsController extends AbstractController
{
    /**
     * @Route("/", name="evenementiels_index", methods={"GET"})
     */
    public function index(EvenementielsRepository $evenementielsRepository): Response
    {
        return $this->render('evenementiels/index.html.twig', [
            'evenementiels' => $evenementielsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="evenementiels_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $evenementiel = new Evenementiels();
        $form = $this->createForm(EvenementielsType::class, $evenementiel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evenementiel);
            $entityManager->flush();

            return $this->redirectToRoute('evenementiels_index');
        }

        return $this->render('evenementiels/new.html.twig', [
            'evenementiel' => $evenementiel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="evenementiels_show", methods={"GET"})
     */
    public function show(Evenementiels $evenementiel): Response
    {
        return $this->render('evenementiels/show.html.twig', [
            'evenementiel' => $evenementiel,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="evenementiels_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Evenementiels $evenementiel): Response
    {
        $form = $this->createForm(EvenementielsType::class, $evenementiel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('evenementiels_index', [
                'id' => $evenementiel->getId(),
            ]);
        }

        return $this->render('evenementiels/edit.html.twig', [
            'evenementiel' => $evenementiel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="evenementiels_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Evenementiels $evenementiel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evenementiel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($evenementiel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('evenementiels_index');
    }
}
