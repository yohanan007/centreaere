<?php

namespace App\Controller;

use App\Entity\Animateurs;
use App\Form\AnimateursType;
use App\Repository\AnimateursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/animateurs")
 */
class AnimateursController extends AbstractController
{
    /**
     * @Route("/", name="animateurs_index", methods={"GET"})
     */
    public function index(AnimateursRepository $animateursRepository): Response
    {
        return $this->render('animateurs/index.html.twig', [
            'animateurs' => $animateursRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="animateurs_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $animateur = new Animateurs();
        $form = $this->createForm(AnimateursType::class, $animateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($animateur);
            $entityManager->flush();

            return $this->redirectToRoute('animateurs_index');
        }

        return $this->render('animateurs/new.html.twig', [
            'animateur' => $animateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="animateurs_show", methods={"GET"})
     */
    public function show(Animateurs $animateur): Response
    {
        return $this->render('animateurs/show.html.twig', [
            'animateur' => $animateur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="animateurs_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Animateurs $animateur): Response
    {
        $form = $this->createForm(AnimateursType::class, $animateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('animateurs_index', [
                'id' => $animateur->getId(),
            ]);
        }

        return $this->render('animateurs/edit.html.twig', [
            'animateur' => $animateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="animateurs_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Animateurs $animateur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$animateur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($animateur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('animateurs_index');
    }
}
