<?php

namespace JobBoardBundle\Controller;

use JobBoardBundle\Entity\Advert;
use JobBoardBundle\Form\AdvertType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $adverts = $em->getRepository('JobBoardBundle:Advert')->findAll();
        return $this->render('JobBoardBundle:Default:index.html.twig', array(
            'adverts' => $adverts
        ));
    }

    public function createAction(Request $request){
        //initialisation du getManager et du User
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        //création d'un form sur le modèle AdvertType
        $advert = new Advert();
        $form = $this->createForm(AdvertType::class, $advert);
        $form->handleRequest($request);

        //vérification si le form a été validé
        if ($form->isSubmitted() && $form->isValid()){
            $advert->setTitle($form->get('title')->getData());
            $advert->setContent($form->get('content')->getData());
            $advert->setKeyWords($form->get('keyWords')->getData());
            $advert->setAutor($user);
            $advert->setCreationDate(new \DateTime('now'));

            $em->persist($advert);
            $em->flush();

            $this->redirectToRoute('/job_board');
        }

        return $this->render('JobBoardBundle:Create:generateAdvert.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
