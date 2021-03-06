<?php

namespace ClicSape\Bundle\ClotheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Gamme
 *
 * @ORM\Table(name="gamme")
 * @ORM\Entity(repositoryClass="ClicSape\Bundle\ClotheBundle\Entity\GammeRepository")
 */
class Gamme
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\Type(type="string")
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     * @Assert\Type(type="string")
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;
    
    /**
     * 
     * @ORM\ManyToMany(targetEntity="ClicSape\Bundle\ClotheBundle\Entity\Category", mappedBy="gammes")
     */
    private $categories;
    
    /**
     * @var ArrayCollection Picture
     *
     * @ORM\OneToMany(targetEntity="ClicSape\Bundle\CoreBundle\Entity\Picture", mappedBy="gamme", cascade={"persist"})
     */
    private $pictures;
    
    /**
     * 
     * Constructeur
     */
    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->pictures = new ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Gamme
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
     * Set description
     *
     * @param string $description
     * @return Gamme
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    
    /**
     * Add categories
     *
     * @param \ClicSape\Bundle\ClotheBundle\Entity\Category $categories
     * @return Gamme
     */
    public function addCategory(\ClicSape\Bundle\ClotheBundle\Entity\Category $categories)
    {
        $this->categories[] = $categories;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \ClicSape\Bundle\ClotheBundle\Entity\Category $categories
     */
    public function removeCategory(\ClicSape\Bundle\ClotheBundle\Entity\Category $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->categories;
    }
    
    /**
     * @param Picture $picture
     *
     * @return Article 
     */
     public function addPicture(\ClicSape\Bundle\CoreBundle\Entity\Picture $picture)
    {
        $this->pictures[] = $picture;
        
        return $this;
    }
    
    /**
     * @param Picture $picture
     *
     * @return Article 
     */
    public function removePicture(\ClicSape\Bundle\CoreBundle\Entity\Picture $picture)
    {
        $this->pictures->removeElement($picture);
        
        return $this;
    }

    /**
     *
     * @return ArrayCollection Picture
     */
    public function getPictures()
    {
        return $this->pictures;
    }
}
