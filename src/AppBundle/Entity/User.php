<?php
namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \JobBoardBundle\Entity\Advert
     *
     * @ORM\OneToMany(targetEntity="JobBoardBundle\Entity\Advert", mappedBy="autor", cascade={"remove", "persist"})
     */
    private $adverts;

    /**
     * @var \JobBoardBundle\Entity\Advert
     *
     * @ORM\ManyToMany(targetEntity="JobBoardBundle\Entity\Advert", mappedBy="applyers")
     */
    private $applying;

    /**
     * get id
     *
     *@return integer
     */
    public function getId(){
        return $this->id;
    }

    /**
     * get adverts
     *
     * @return \JobBoardBundle\Entity\Advert
     */
    public function getAdverts(){
        return $this->adverts;
    }

    /**
     * add advert
     *
     * @param \JobBoardBundle\Entity\Advert $advert
     *
     * @return User
     */
    public function addAdvert(\JobBoardBundle\Entity\Advert $advert){
        $this->adverts[] = $advert;
        return $this;
    }

    /**
     * remove advert
     *
     * @param \JobBoardBundle\Entity\Advert
     */
    public function removeAdvert(\JobBoardBundle\Entity\Advert $advert){
        $this->adverts->removeElement($advert);
    }

    /**
     * Get applying
     *
     * @return \JobBoardBundle\Entity\Advert
     */
    public function getApplying(){
        return $this->applying;
    }

    /**
     * Add apply
     *
     * @param \JobBoardBundle\Entity\Advert
     *
     * @return User
     */
    public function addApply(\JobBoardBundle\Entity\Advert $advert){
        $this->applying[] = $advert;
        return $this;
    }

    /**
     * Remove apply
     *
     * @param \JobBoardBundle\Entity\Advert
     */
    public function removeApply(\JobBoardBundle\Entity\Advert $advert){
        $this->applying->removeElement($advert);
    }
}