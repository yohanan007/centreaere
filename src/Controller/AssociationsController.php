<?php

namespace App\Controller;

use App\Entity\Associations;
use App\Form\AssociationsType;
use App\Repository\AssociationsRepository;
use App\Repository\AdministrateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/associations")
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class AssociationsController extends AbstractController
{

    private $passwordEncoder;
    

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }

    /**
     * @Route("/", name="associations_index", methods={"GET"})
     * @IsGranted("ROLE_USER_ADMIN")
     */
    public function index(AssociationsRepository $associationsRepository): Response
    {
        // utilisateur courant 
        $user = $this->getUser();
        if(in_array("ROLE_USER_ADMIN",$user->getRoles()))
        {
            $user_id = $user->getId();
//$adminRepo = new AdministateurRepository();
         //   $admin_current = $adminRepo->findByIdUser($user_id)[0];

          return $this->render('associations/index.html.twig', [
            'associations' => $associationsRepository->findByUserIdRoleAdministrateur($user_id),
        ]);  
        }elseif (in_array("ROLE_SUPER_ADMIN",$user->getRoles())) {
            return $this->render('associations/index.html.twig', [
                'associations' => $associationsRepository->findAll(),
            ]); 
        } 
        
    }

    /**
     * @Route("/new", name="associations_new", methods={"GET","POST"})
     * @IsGranted("ROLE_USER_ADMIN", message="No access! Get out!")
     */
    public function new(Request $request, AdministrateurRepository $adminRepo): Response
    {
        $association = new Associations();
        $form = $this->createForm(AssociationsType::class, $association);
        $form->handleRequest($request);
        $id_user = $this->getUser()->getId();
        $admin_current = $adminRepo->findByIdUser($id_user)[0];
        //var_dump("admin cuurent "." ".$admin_current[0]->getId());
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $association->setAdministrateurs($admin_current);
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
    public function show(Associations $association,$id): Response
    {
        // role_user_admin
        $user = $this->getUser();
        $user_id = $user->getId();
        if(in_array('ROLE_USER_ADMIN',$user->getRole()))
        {
            
            return $this->render('associations/show.html.twig', [
                'association' => $association,
            ]); 
        }
        else{
            return $this->redirectRouteTo('homepage');
        }
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
