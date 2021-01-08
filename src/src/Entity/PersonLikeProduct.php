<?php

namespace  App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PersonLikeProduct
 *
 * @ORM\Table(name="person_like_product")
 * @ORM\Entity(repositoryClass="App\Repository\PersonLikeProductRepository")
 */
class PersonLikeProduct
{
    /**
     * @var int
     *
     * @ORM\Column(name="person_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $personId;

    /**
     * @var int
     *
     * @ORM\Column(name="product_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $productId;

    /**
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="person_like_product")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id")
     */
    private $person;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="person_like_product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;

    public function getPersonId(): ?int
    {
        return $this->personId;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(?Person $person): self
    {
        $this->person = $person;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }


}
