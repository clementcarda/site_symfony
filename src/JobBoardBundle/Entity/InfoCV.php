<?php

namespace JobBoardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JobBoardBundle\JobBoardBundle;

/**
 * InfoCV
 *
 * @ORM\Table(name="info_cv")
 * @ORM\Entity(repositoryClass="JobBoardBundle\Repository\InfoCVRepository")
 */
class InfoCV
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=25)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=25)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=100)
     */
    private $adresse;

    /**
     * @var int
     *
     * @ORM\Column(name="code_postal", type="integer")
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=25)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=150)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=10)
     */
    private $telephone;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User", inversedBy="cv")
     */
    private $auteur;

    /**
     * @var \JobBoardBundle\Entity\Formation
     *
     * @ORM\OneToMany(targetEntity="JobBoardBundle\Entity\Formation", mappedBy="cv", cascade={"remove", "persist"})
     */
    private $formations;

    /**
     * @var \JobBoardBundle\Entity\Competence
     *
     * @ORM\OneToMany(targetEntity="JobBoardBundle\Entity\Competence", mappedBy="cv", cascade={"remove", "persist"})
     */
    private $competences;

    /**
     * @var \JobBoardBundle\Entity\ExperienceProfessionnelle
     *
     * @ORM\OneToMany(targetEntity="JobBoardBundle\Entity\ExperienceProfessionnelle", mappedBy="cv", cascade={"remove", "persist"})
     */
    private $experiences;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return InfoCV
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return InfoCV
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return InfoCV
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set codePostal
     *
     * @param integer $codePostal
     *
     * @return InfoCV
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return int
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return InfoCV
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return InfoCV
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return InfoCV
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set auteur
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return InfoCV
     */
    public function setAuteur($user){
        $this->auteur = $user;
        return $this;
    }

    /**
     * Get auteur
     *
     * @return \AppBundle\Entity\User
     */
    public function getAuteur(){
        return $this->auteur;
    }

    /**
     * Get formations
     *
     * @return \JobBoardBundle\Entity\Formation
     */
    public function getFormations(){
        return $this->formations;
    }

    /**
     * Add formation
     *
     * @param \JobBoardBundle\Entity\Formation $formation
     *
     * @return InfoCV
     */
    public function addFormation($formation){
        $this->formations[] = $formation;
        return $this;
    }

    /**
     * Remove Formation
     *
     * @param \JobBoardBundle\Entity\Formation $formation
     */
    public function removeFormation($formation){
        $this->formations->removeElement($formation);
    }

    /**
     * Get competences
     *
     *@return \JobBoardBundle\Entity\Competence
     */
    public function getCompetences(){
        return $this->competences;
    }

    /**
     * Add competence
     *
     * @param \JobBoardBundle\Entity\Competence $competence
     *
     * @return InfoCV
     */
    public function addCompetence($competence){
        $this->competences[] = $competence;
        return $this;
    }

    /**
     * Remove competence
     *
     * @param \JobBoardBundle\Entity\Competence $competence
     */
    public function removeCompetence($competence){
        $this->competences->removeElement($competence);
    }

    /**
     * Get experiences
     *
     * @return \JobBoardBundle\Entity\ExperienceProfessionnelle
     */
    public function getExperiences(){
        return $this->experiences;
    }
    /**
     * Add experience
     *
     * @param \JobBoardBundle\Entity\ExperienceProfessionnelle $experience
     *
     * @return InfoCV
     */
    public function addExperience($experience){
        $this->experiences[] = $experience;
        return $this;
    }

    /**
     * Remove experience
     *
     * @param \JobBoardBundle\Entity\ExperienceProfessionnelle $experience
     */
    public function removeExperience($experience){
        $this->experiences->removeElement($experience);
    }
}

