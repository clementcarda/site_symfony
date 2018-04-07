<?php

namespace JobBoardBundle\Controller;

use JobBoardBundle\Entity\Competence;
use JobBoardBundle\Entity\ExperienceProfessionnelle;
use JobBoardBundle\Entity\Formation;
use JobBoardBundle\Entity\InfoCV;
use JobBoardBundle\Form\CompetenceType;
use JobBoardBundle\Form\ExperienceProfessionnelleType;
use JobBoardBundle\Form\FormationType;
use JobBoardBundle\Form\InfoCVType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CVControllerController extends Controller
{
    public function showCvAction(Request $request, $userId = null){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        if($userId){
            $user = $em->find('AppBundle:User', $userId);
        }

        $cv = $em->getRepository('JobBoardBundle:InfoCV')->findOneBy(array(
            'auteur' => $user
        ));

        return $this->render('JobBoardBundle:CVController:show_cv.html.twig', array(
            'cv' => $cv,
            'myId' => $this->getUser()->getId(),
        ));
    }

    public function editCvAction(Request $request){
        //récupération des données courante
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        //récupération du InfoCV du user
        $myInfo = $em->getRepository('JobBoardBundle:InfoCV')->findOneBy(array(
            'auteur' => $user
        ));

        //création du formulaire du cv
        $infoCv = new InfoCV();
        $form = $this->createForm(InfoCVType::class, $infoCv);
        $form->handleRequest($request);

        //si le form est valider pousser les infos dans la bdd sinon prérenplir le formulaire
        if($form->isSubmitted() && $form->isValid()){
            //si le user n'a pas encore de cv
            if(!$myInfo){
                $myInfo = new InfoCV();
            }

            $myInfo->setNom($form->get('nom')->getData());
            $myInfo->setPrenom($form->get('prenom')->getData());
            $myInfo->setAdresse($form->get('adresse')->getData());
            $myInfo->setcodePostal($form->get('codePostal')->getData());
            $myInfo->setVille($form->get('ville')->getData());
            $myInfo->setTelephone($form->get('telephone')->getData());
            $myInfo->setmail($form->get('mail')->getData());
            $myInfo->setAuteur($this->getUser());
            $em->persist($myInfo);
            $em->flush();

            return $this->redirectToRoute('show_mycv');
        } else if($myInfo){
            $form->get('nom')->setData($myInfo->getNom());
            $form->get('prenom')->setData($myInfo->getPrenom());
            $form->get('adresse')->setData($myInfo->getAdresse());
            $form->get('codePostal')->setData($myInfo->getCodePostal());
            $form->get('ville')->setData($myInfo->getVille());
            $form->get('telephone')->setData($myInfo->getTelephone());
            $form->get('mail')->setData($myInfo->getMail());
        }

        return $this->render('JobBoardBundle:CVController:edit_cv.html.twig', array(
            'form' => $form->createView(),
            'cv' => $myInfo
        ));

    }

    public function editFormationAction(Request $request, $id){
        //récupération du user et formation courant
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $formation = $em->getRepository('JobBoardBundle:Formation')->find($id);
        $cv = $em->getRepository('JobBoardBundle:InfoCV')->findOneBy(array(
            'auteur' => $user
        ));

        //création du formulaire
        if(!$formation){
            $formation = new Formation();
        }
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $formation->setNom($form->get('nom')->getData());
            $formation->setDuree($form->get('duree')->getData());
            $formation->setCommentaire($form->get('commentaire')->getData());
            $formation->setCv($cv);

            $em->persist($formation);
            $em->flush();

            return $this->redirectToRoute('show_mycv');


        }


        return $this->render('JobBoardBundle:CVController:editFormation.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function editCompetenceAction(Request $request, $id){
        //récupération du user et competence courant
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $competence = $em->getRepository('JobBoardBundle:Competence')->find($id);
        $cv = $em->getRepository('JobBoardBundle:InfoCV')->findOneBy(array(
            'auteur' => $user
        ));

        //création du formulaire
        if(!$competence){
            $competence = new Competence();
        }
        $form = $this->createForm(CompetenceType::class, $competence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $competence->setNom($form->get('nom')->getData());
            $competence->setNiveau($form->get('niveau')->getData());
            $competence->setCommentaire($form->get('commentaire')->getData());
            $competence->setCV($cv);

            $em->persist($competence);
            $em->flush();

            return $this->redirectToRoute('show_mycv');


        }


        return $this->render('JobBoardBundle:CVController:editCompetence.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function editExperienceAction(Request $request, $id){
        //récupération du user et experience courant
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $experience = $em->getRepository('JobBoardBundle:ExperienceProfessionnelle')->find($id);
        $cv = $em->getRepository('JobBoardBundle:InfoCV')->findOneBy(array(
            'auteur' => $user
        ));

        //création du formulaire
        if(!$experience){
            $experience = new ExperienceProfessionnelle();
        }
        $form = $this->createForm(ExperienceProfessionnelleType::class, $experience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $experience->setPeriode($form->get('periode')->getData());
            $experience->setOrganisme($form->get('organisme')->getData());
            $experience->setPoste($form->get('poste')->getData());
            $experience->setCommentaire($form->get('commentaire')->getData());
            $experience->setCV($cv);

            $em->persist($experience);
            $em->flush();

            return $this->redirectToRoute('show_mycv');


        }


        return $this->render('JobBoardBundle:CVController:editExperience.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
