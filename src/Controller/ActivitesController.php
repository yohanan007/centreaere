<?php

namespace App\Controller;

use App\Entity\Activites;
use App\Entity\Administrateur;
use App\Entity\Journaliers;
use App\Form\ActivitesType;
use App\Form\JournaliersType;
use App\Repository\ActivitesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/activites")
 */
class ActivitesController extends AbstractController
{
    /**
     * @Route("/", name="activites_index", methods={"GET"})
     */
    public function index(ActivitesRepository $activitesRepository): Response
    {
        return $this->render('activites/index.html.twig', [
            'activites' => $activitesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="activites_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $repository2 = $this->getDoctrine()->getRepository(Administrateur::class);
        $activite = new Activites();
        $admin = new Administrateur();
        $activite->setAdministrateurs($repository2->findOneBy(['users'=>$this->getUser()]));
        $form = $this->createForm(ActivitesType::class, $activite,['user'=>$this->getUser()->getId()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $journalier = $activite->getJournaliers();
            $evenementiel = $activite->getEvenementiels();
            if($journalier)
            {
                foreach ($journalier as $item) {
                    $item->setActivites($activite);
                    $entityManager->persist($item);
                }
            }elseif ($evenementiel) {
                foreach ($evenementiel as $item) {
                    $item->setActivites($activite);
                    $entityManager->persist($item);
                }
            }
            $entityManager->persist($activite);
            $entityManager->flush();

            return $this->redirectToRoute('activites_index');
        }

        return $this->render('activites/new.html.twig', [
            'activite' => $activite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="activites_show", methods={"GET"})
     */
    public function show(Activites $activite): Response
    {
        return $this->render('activites/show.html.twig', [
            'activite' => $activite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="activites_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Activites $activite): Response
    {
        $form = $this->createForm(ActivitesType::class, $activite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('activites_index', [
                'id' => $activite->getId(),
            ]);
        }

        return $this->render('activites/edit.html.twig', [
            'activite' => $activite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="activites_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Activites $activite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$activite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($activite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('activites_index');
    }
}
