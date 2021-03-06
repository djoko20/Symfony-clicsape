<?php

namespace ClicSape\Bundle\ClotheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Size
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ClicSape\Bundle\ClotheBundle\Entity\SizeRepository")
 */
class Size
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
     * @var integer
     *
     * @ORM\Column(name="level", type="integer")
     */
    private $level;

    /**
     * @var string
     *
     * @ORM\Column(name="wording", type="string", length=20)
     */
    private $wording;

    /**
     * @var ArrayCollection GroupSize
     *
     * @ORM\ManyToOne(targetEntity="ClicSape\Bundle\ClotheBundle\Entity\GroupSize", inversedBy="sizes")
     */
    private $groupSize;
    
    /**
     * 
     * Constructeur
     */
    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->articles = new ArrayCollection();
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
     * Set level
     *
     * @param integer $level
     * @return Size
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return integer 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set wording
     *
     * @param string $wording
     * @return Size
     */
    public function setWording($wording)
    {
        $this->wording = $wording;

        return $this;
    }

    /**
     * Get wording
     *
     * @return string 
     */
    public function getWording()
    {
        return $this->wording;
    }
    
    /**
     * @param Article $article
     *
     * @return Size 
     */
     public function addArticle(Article $article)
    {
        $this->articles[] = $article;
        
        return $this;
    }
    
    /**
     * @param Article $article
     *
     * @return Size 
     */
    public function removeArticle(Article $article)
    {
        $this->articles->removeElement($article);
        
        return $this;
    }

    /**
     *
     * @return ArrayCollection Article
     */
    public function getArticles()
    {
        return $this->articles;
    }
    

    /**
     * Set groupSize
     *
     * @param \ClicSape\Bundle\ClotheBundle\Entity\GroupSize $groupSize
     * @return Size
     */
    public function setGroupSize(GroupSize $groupSize = null)
    {
        $this->groupSize = $groupSize;

        return $this;
    }

    /**
     * Get groupSize
     *
     * @return \ClicSape\Bundle\ClotheBundle\Entity\GroupSize 
     */
    public function getGroupSize()
    {
        return $this->groupSize;
    }
}
