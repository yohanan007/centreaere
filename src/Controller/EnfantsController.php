<?php

namespace App\Controller;

use App\Entity\Enfants;
use App\Entity\Parents;
use App\Entity\ActivitesEnfants;
use App\Form\ActivitesEnfantsChildType;
use App\Form\EnfantsType;
use App\Repository\EnfantsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/enfants")
 */
class EnfantsController extends AbstractController
{

    private $passwordEncoder;
    

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }

    /**
     * @Route("/", name="enfants_index", methods={"GET"})
     */
    public function index(EnfantsRepository $enfantsRepository): Response
    {
        $user = $this->getUser();
        if(in_array('USER_ROLE_PARENT',$user->getRoles()))
        {
           return $this->render('enfants/index.html.twig', [
            'enfants' => $enfantsRepository->findByIdUserRoleParent($user->getId()),
        ]); 
        }else{
            return $this->redirectToRoute('homepage');
        }
        
    }

    /**
     * @Route("/new", name="enfants_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $user = $this->getUser();
        if(in_array('USER_ROLE_PARENT',$user->getRoles()))
        {
            $enfant = new Enfants();
            $parent_user = $this->getDoctrine()->getRepository(Parents::class)->findOneBy(['utilisateur'=>$this->getUser()]);
           // var_dump($parent_user);
            $form = $this->createForm(EnfantsType::class, $enfant);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();

                $user_enfant_en_cours =  $enfant->getUser();
                $user_enfant_en_cours->setRoles(["USER_ROLE_ENFANT"]);

                $user_enfant_en_cours->setPassword($this->passwordEncoder->encodePassword(
                    $user_enfant_en_cours,
                    $user_enfant_en_cours->getPassword()
                ));

                $enfant->setUser($user_enfant_en_cours);
                $enfant->addParent($parent_user);

                $entityManager->persist($user_enfant_en_cours);
                $entityManager->persist($enfant);
                $entityManager->flush();

                return $this->redirectToRoute('enfants_index');
        }

            return $this->render('enfants/new.html.twig', [
                'enfant' => $enfant,
                'form' => $form->createView(),
            ]);
        }
        // fin condition rôle
        else {
            return $this->redirectToRoute('homepage');
        }
       
    }

    /**
     * @Route("/{id}", name="enfants_show", methods={"GET"})
     */
    public function show(Enfants $enfant): Response
    {
        $user = $this->getUser();
        $activiteEnfant = new ActivitesEnfants();

        $form = $this->createForm(ActivitesEnfantsChildType::class, $activiteEnfant,['utilisateur_id'=>$user->getId(),]); 

        return $this->render('enfants/show.html.twig', [
            'enfant' => $enfant,
            'form'=> $form->createView(), 
        ]);
    }

    /**
     * @Route("/{id}/edit", name="enfants_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Enfants $enfant): Response
    {
        $form = $this->createForm(EnfantsType::class, $enfant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('enfants_index', [
                'id' => $enfant->getId(),
            ]);
        }

        return $this->render('enfants/edit.html.twig', [
            'enfant' => $enfant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="enfants_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Enfants $enfant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$enfant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($enfant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('enfants_index');
    }


    /**
     * @Route("/inscription/{id}", name="enfants_inscription", methods={"POST"})
     */
    public function inscription(Request $request): Response
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $enfant = $this->getDoctrine()->getRepository(Enfants::class)->findOneBy(['id'=>$id]);
            $activiteEnfant = $request->getData();
            $activiteEnfant->setEnfants($enfant);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($activiteEnfant);
            $entityManager->flush();
        }
        return $this->redirectToRoute('enfants_show',array('id'=>$id));
    }
}
