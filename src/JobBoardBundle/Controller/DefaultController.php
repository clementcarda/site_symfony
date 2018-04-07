<?php

namespace JobBoardBundle\Controller;

use JobBoardBundle\Entity\Advert;
use JobBoardBundle\Form\AdvertType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use JobBoardBundle\ListKeyWord;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $keyWord = $session->get('recherche');



        $skills = array();
        foreach (ListKeyWord::$skills as $key => $element){
            $skills[$key] = $element;
        }

        $defaultData = array();
        $searchForm = $this->createFormBuilder($defaultData)
            ->add('key_words', ChoiceType::class, array(
                'choices' => $skills,
                'multiple' => true,
                'expanded' => true
            ))
            ->add('Submit', SubmitType::class)
            ->getForm();

        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted() && $searchForm->isValid()){
            $keyWord = $searchForm->getData()['key_words'];
            $session->set('recherche', $keyWord);

        }


            $adverts = $em->getRepository('JobBoardBundle:Advert')
                ->findAll();
        if (count($keyWord) > 0){
            $choosesAdvert = array();
            foreach ($adverts as $advert){
                foreach ($advert->getKeyWords() as $skill){
                    if(in_array($skill, $keyWord) && !in_array($advert, $choosesAdvert)){
                        $choosesAdvert[] = $advert;
                    }
                }
            }
            $adverts = $choosesAdvert;

        }






        return $this->render('JobBoardBundle:Default:index.html.twig', array(
            'adverts' => $adverts,
            'searchform' => $searchForm->createView()
        ));
    }

    public function editAction(Request $request, $id){
        //initialisation du getManager et du User
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $advert = $em->getRepository('JobBoardBundle:Advert')->find($id);

        //création d'un form sur le modèle AdvertType
        if (!$advert){
            $advert = new Advert();
        }

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

            return $this->redirectToRoute('job_board_index');
        }

        return $this->render('JobBoardBundle:Create:generateAdvert.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function viewAction(Request $request, $id){
        $user = $this->getUser();
        $advert = $this->getDoctrine()->getRepository(Advert::class)->find($id);
        $applyers = $advert->getApplyers();
        if (!$advert){
            throw $this->createNotFoundException(
                'Aucune annonce pour cet Identifiant '.$id
            );
        }

        return $this->render('JobBoardBundle:Default:viewAdvert.html.twig', array(
            'advert' => $advert,
            'user' => $user,
            'applyers' => $applyers
        ));
    }

    public function applyAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();

        $advert = $em->getRepository(Advert::class)->find($id);
        $user = $this->getUser();

        $advert->addApplyer($user);

        $em->persist($advert);
        $em->flush();

        return $this->redirectToRoute('job_board_index');
    }

}
