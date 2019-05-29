<?php

namespace App\Controller;

use App\Entity\Administrateur;
use App\Form\AdministrateurType;
use App\Repository\AdministrateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * @Route("/administrateur")
 */
class AdministrateurController extends AbstractController
{

    private $passwordEncoder;
    

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
         
      
     }
    /**
     * @Route("/", name="administrateur_index", methods={"GET"})
     */
    public function index(AdministrateurRepository $administrateurRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
       
        $user = $this->getUser();

        return $this->render('administrateur/index.html.twig', [
            'administrateurs' => $administrateurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="administrateur_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $administrateur = new Administrateur();
        $form = $this->createForm(AdministrateurType::class, $administrateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            // recupération de l'utilisateur
            $user = $administrateur->getUsers();
            // ajout du rôle 
            $user->setRoles(["ROLE_USER_ADMIN"]);
            // encodage du password
            $user->setPassword($this->passwordEncoder->encodePassword(
                             $user,
                             $user->getPassword()
                         ));
            // apres les différentes transformations l'utilisateur ets intégré dans l'administrateur
            $administrateur->setUsers($user);
            //var_dump($administrateur->getUsers());
            $entityManager->persist($administrateur);
            $entityManager->flush();

            return $this->redirectToRoute('administrateur_index');
        }

        return $this->render('administrateur/new.html.twig', [
            'administrateur' => $administrateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="administrateur_show", methods={"GET"})
     */
    public function show(AdministrateurRepository $administrateurRepository, Administrateur $administrateur,$id): Response
    {
        
        // recuperation de l'utilisateur courant
        $user = $this->getUser();
        // recuperation de l'id utilisateur courant
        $id_user = $user->getId();

        // recuperation de l'id adminstrateur courant
        $id_administrateur_courant = $administrateurRepository->findByIdUser($id_user)[0]->getId();

        // verification du bon id de l'utilisateur
        if(($id_administrateur_courant == $id)||(in_array('ROLE_SUPER_ADMIN',$user->getRoles())))
        {
            
          return $this->render('administrateur/show.html.twig', [
            'administrateur' => $administrateur,
        ]);  
        }else{
            return $this->redirectToRoute('homepage');
      
        }

        
    }

    /**
     * @Route("/{id}/edit", name="administrateur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Administrateur $administrateur,AdministrateurRepository $administrateurRepository, $id ): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        // recuperation de l'id utilisateur courant 
        $user_id = $this->getUser()->getId();

        $id_administrateur_courant = $administrateurRepository->findByIdUser($user_id)[0]->getId();
        if($id_administrateur_courant == $id)
        {
            $form = $this->createForm(AdministrateurType::class, $administrateur);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('administrateur_index', [
                    'id' => $administrateur->getId(),
                ]);
            }

            return $this->render('administrateur/edit.html.twig', [
                'administrateur' => $administrateur,
                'form' => $form->createView(),
            ]);
        }
        else {
             return redirect('/');
        }

       
    }

    /**
     * @Route("/{id}", name="administrateur_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Administrateur $administrateur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$administrateur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($administrateur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('administrateur_index');
    }
}
