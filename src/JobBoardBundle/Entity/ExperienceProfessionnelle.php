<?php

namespace JobBoardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExperienceProfessionnelle
 *
 * @ORM\Table(name="experience_professionnelle")
 * @ORM\Entity(repositoryClass="JobBoardBundle\Repository\ExperienceProfessionnelleRepository")
 */
class ExperienceProfessionnelle
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
     * @ORM\Column(name="periode", type="string", length=255)
     */
    private $periode;

    /**
     * @var string
     *
     * @ORM\Column(name="organisme", type="string", length=100)
     */
    private $organisme;

    /**
     * @var string
     *
     * @ORM\Column(name="poste", type="string", length=50)
     */
    private $poste;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text")
     */
    private $commentaire;

    /**
     * @var \JobBoardBundle\Entity\InfoCV
     *
     * @ORM\ManyToOne(targetEntity="JobBoardBundle\Entity\InfoCV", inversedBy="experiences")
     */
    private $cv;


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
     * Set periode
     *
     * @param string $periode
     *
     * @return ExperienceProfessionnelle
     */
    public function setPeriode($periode)
    {
        $this->periode = $periode;

        return $this;
    }

    /**
     * Get periode
     *
     * @return string
     */
    public function getPeriode()
    {
        return $this->periode;
    }

    /**
     * Set organisme
     *
     * @param string $organisme
     *
     * @return ExperienceProfessionnelle
     */
    public function setOrganisme($organisme)
    {
        $this->organisme = $organisme;

        return $this;
    }

    /**
     * Get organisme
     *
     * @return string
     */
    public function getOrganisme()
    {
        return $this->organisme;
    }

    /**
     * Set poste
     *
     * @param string $poste
     *
     * @return ExperienceProfessionnelle
     */
    public function setPoste($poste)
    {
        $this->poste = $poste;

        return $this;
    }

    /**
     * Get poste
     *
     * @return string
     */
    public function getPoste()
    {
        return $this->poste;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return ExperienceProfessionnelle
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set cv
     *
     * @param \JobBoardBundle\Entity\InfoCV $cv
     *
     * @return ExperienceProfessionnelle
     */
    public function setCv($cv){
        $this->cv = $cv;
        return $this;
    }

    /**
     * Get cv
     *
     * @return \JobBoardBundle\Entity\InfoCV
     */
    public function getCv(){
        return $this->cv;
    }
}

