<?php 

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @author Alyson Rodrigo
 * @ORM\Entity(repositoryClass="Base\Repository\CategoryRepository")
 * @ORM\Table(name="category")
 */
class Category implements BaseEntityInterface{

    /**
     * @var int
     * @ORM\Id 
     * @Type("int")
     * @ORM\Column(type="integer", nullable=false) 
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @Type("string")
     * @ORM\Column
     * @NotBlank(groups={"insert", "update"}, message="O campo name é obrigatório!")
     * @var string
    */
    protected $name;

    /**
     * @Type("string") 
     * @ORM\Column
     *  
     */
    protected $description;

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

}