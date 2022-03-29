<?php 

namespace Base\Entity;

use Doctrine\ORM\Mapping AS ORM;

use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @author Alyson Rodrigo
 * @ORM\Entity(repositoryClass="Base\Repository\ProductRepository")
 * @ORM\Table(name="product")
 */
class Product implements BaseEntityInterface{

    /**
     * @ORM\Id 
     * @Type("int")
     * @ORM\Column(type="integer", nullable=false) 
     * @ORM\GeneratedValue
     * @var int
    */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Base\Entity\Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * @ORM\Column(type="string")
     * @var string
    */
    protected $name;
    protected $description;
    protected $price;
    protected $quantity;
    protected $unity;
    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of category
     */ 
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @return  self
     */ 
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of quantity
     */ 
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */ 
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get the value of unity
     */ 
    public function getUnity()
    {
        return $this->unity;
    }

    /**
     * Set the value of unity
     *
     * @return  self
     */ 
    public function setUnity($unity)
    {
        $this->unity = $unity;

        return $this;
    }
}