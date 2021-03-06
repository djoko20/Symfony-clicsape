<?php

namespace ClicSape\Bundle\ClotheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GroupSize
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ClicSape\Bundle\ClotheBundle\Entity\GroupSizeRepository")
 */
class GroupSize
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
     *
     * @ORM\Column(name="title", type="string", length=55)
     */
    private $title;

    /**
     * @var boolean
     *
     * @ORM\Column(name="disabled", type="boolean")
     */
    private $disabled;
    
    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="ClicSape\Bundle\CoreBundle\Entity\Country", inversedBy="groupSizes", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $countries;
    
    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ClicSape\Bundle\ClotheBundle\Entity\Size", mappedBy="groupSize",cascade={"detach","persist"})
     */
    private $sizes;
    
    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="ClicSape\Bundle\ClotheBundle\Entity\Category", mappedBy="groupSizes")
     * @ORM\JoinColumn(nullable=true)
     */
    private $categories;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sizes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->countries = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return GroupSize
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
     * Set disabled
     *
     * @param boolean $disabled
     * @return GroupSize
     */
    public function setDisabled($disabled = null)
    {
        $this->disabled = $disabled;

        return $this;
    }

    /**
     * Get disabled
     *
     * @return boolean 
     */
    public function getDisabled()
    {
        return $this->disabled;
    }
    

    /**
     * Add size
     *
     * @param \ClicSape\Bundle\ClotheBundle\Entity\Size $size
     * @return GroupSize
     */
    public function addSize(Size $size)
    {
        $this->sizes[] = $size;

        return $this;
    }

    /**
     * Remove size
     *
     * @param \ClicSape\Bundle\ClotheBundle\Entity\Size $size
     */
    public function removeSize(Size $size)
    {
        $this->sizes->removeElement($size);
    }

    /**
     * Get sizes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSizes()
    {
        return $this->sizes;
    }

    /**
     * Add categorie
     *
     * @param \ClicSape\Bundle\ClotheBundle\Entity\Category $categorie
     * @return GroupSize
     */
    public function addCategory(\ClicSape\Bundle\ClotheBundle\Entity\Category $categorie)
    {
        $this->categories[] = $categorie;

        return $this;
    }

    /**
     * Remove categorie
     *
     * @param \ClicSape\Bundle\ClotheBundle\Entity\Category $categorie
     */
    public function removeCategory(\ClicSape\Bundle\ClotheBundle\Entity\Category $categorie)
    {
        $this->categories->removeElement($categorie);
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
     * Add country
     *
     * @param \ClicSape\Bundle\CoreBundle\Entity\Country $country
     * @return GroupSize
     */
    public function addCountry(\ClicSape\Bundle\CoreBundle\Entity\Country $country)
    {
        $this->countries[] = $country;

        return $this;
    }

    /**
     * Remove country
     *
     * @param \ClicSape\Bundle\CoreBundle\Entity\Country $country
     */
    public function removeCountry(\ClicSape\Bundle\CoreBundle\Entity\Country $country)
    {
        $this->countries->removeElement($country);
    }

    /**
     * Get countries
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCountries()
    {
        return $this->countries;
    }

}
