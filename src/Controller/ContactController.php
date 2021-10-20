<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact_list")
     */
    public function index(ContactRepository $repo)
    {
        
        $contacts = $repo->findAll();

        return $this->render('contact/liste.html.twig', [
            'contacts' => $contacts
        ]);
    }
    
    /**
     * Permet de créer une annonce
     *
     * @Route("/contact/new", name="contact_create")
     * 
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager){
        $contact=new Contact();

        $form = $this->createForm(ContactType::class, $contact);

        //met les infos du formulaire ds une variable
        $form->handleRequest($request);

        

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($contact);
            $manager->flush();


        }

        return $this->render('contact/new.html.twig', [
            'form' => $form->createView()
        ]);
    }   
}
