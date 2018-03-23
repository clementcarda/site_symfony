<?php

namespace JobBoardBundle\Entity;

use AppBundle\AppBundle;
use Doctrine\ORM\Mapping as ORM;

/**
 * Advert
 *
 * @ORM\Table(name="advert")
 * @ORM\Entity(repositoryClass="JobBoardBundle\Repository\AdvertRepository")
 */
class Advert
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
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="adverts")
     */
    private $autor;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=150)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetime")
     */
    private $creationDate;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var array
     *
     * @ORM\Column(name="key_words", type="array")
     */
    private $keyWords;


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
     * Get autor
     *
     * @return \AppBundle\Entity\User
     */
    public function getAutor(){
        return $this->autor;
    }

    /**
     * Set autor
     *
     * @param \AppBundle\Entity\User $autor
     *
     * @return Advert
     */
    public function setAutor($autor){
        $this->autor = $autor;
        return $this;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Advert
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return Advert
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Advert
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set keyWords
     *
     * @param array $keyWords
     *
     * @return Advert
     */
    public function setKeyWords($keyWords)
    {
        $this->keyWords = $keyWords;

        return $this;
    }

    /**
     * Add keyWord
     *
     * @param string $keyWord
     *
     * @return Advert
     */
    public function addKeyWord($keyWord){
        $this->keyWords[] = $keyWord;
        return $this;
    }

    /**
     * Remove keyWord
     *
     * @param string $keyWord
     */
    public function removeKeyWord($keyWord){
        $this->keyWords->removeElement($keyWord);
    }

    /**
     * Get keyWords
     *
     * @return array
     */
    public function getKeyWords()
    {
        return $this->keyWords;
    }
}

