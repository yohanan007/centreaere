<?php

namespace App\Controller;

use App\Entity\ParentsAssociations;
use App\Form\ParentsAssociationsType;
use App\Repository\ParentsAssociationsRepository;
use App\Entity\Parents;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


/**
 * @Route("/parents/associations")
 * @IsGranted("IS_AUTHENTICATED_FULLY", message="No access! Get out!")
 */
class ParentsAssociationsController extends AbstractController
{

    private $passwordEncoder;
    

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }

    /**
     * @Route("/", name="parents_associations_index", methods={"GET"})
     */
    public function index(ParentsAssociationsRepository $parentsAssociationsRepository): Response
    {
        if(in_array('USER_ROLE_PARENT',$this->getUser()->getRoles()))
        {
            $parentsRepository = $this->getDoctrine()->getRepository(Parents::class);
            $parentsAssociation = $parentsRepository->findByIdUserInfoAssociation($this->getUser()->getId());
            return $this->render('parents_associations/index.html.twig', [
                'parents_associations' => $parentsAssociation,
            ]);
        }else {
             return $this->render('parents_associations/index.html.twig', [
            'parents_associations' => $parentsAssociationsRepository->findAll(),
        ]);# code...
        }
       
    }

    /**
     * @Route("/new", name="parents_associations_new", methods={"GET","POST"})
     * @IsGranted("ROLE_USER_ADMIN", message="No access! Get out!")
     */
    public function new(Request $request): Response
    {
        $parentsAssociation = new ParentsAssociations();
        $form = $this->createForm(ParentsAssociationsType::class, $parentsAssociation, ['user'=>$this->getUser()->getId(),]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            // récupération de l'utilisateur en cours d'inscription
            $user_inscription = $parentsAssociation->getParents()->getUtilisateur();
            // on donne un rôle
            $user_inscription->setRoles(["USER_ROLE_PARENT"]);
            // encodage du password dans la base de donnée
            $user_inscription->setPassword($this->passwordEncoder->encodePassword(
                $user_inscription,
                $user_inscription->getPassword()
            ));

            // persistence des données 
            $entityManager->persist($user_inscription);
            $entityManager->persist($parentsAssociation->getParents());
            $entityManager->persist($parentsAssociation);

            // enregistrement des données
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
