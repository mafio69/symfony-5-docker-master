<?php

namespace  App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Person
 *
 * @ORM\Table(name="person")
 * @ORM\Entity(repositoryClass="App\Repository\PersonRepository")
 */
class Person
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=100, nullable=false)
     */
    private string $login;

    /**
     * @var string
     *
     * @ORM\Column(name="l_name", type="string", length=100, nullable=false, options={"comment"="last name"})
     */
    private string $lName;

    /**
     * @var string
     *
     * @ORM\Column(name="f_name", type="string", length=100, nullable=false, options={"comment"="first name"})
     */
    private string $fName;

    /**
     * @var int
     *
     * @ORM\Column(name="state", type="smallint", nullable=false, options={"unsigned"=true,"comment"="1 - active, 2- banned, 3 - deleted"})
     */
    private int $state;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getLName(): ?string
    {
        return $this->lName;
    }

    public function setLName(string $lName): self
    {
        $this->lName = $lName;

        return $this;
    }

    public function getFName(): ?string
    {
        return $this->fName;
    }

    public function setFName(string $fName): self
    {
        $this->fName = $fName;

        return $this;
    }

    public function getState(): ?int
    {
        return $this->state;
    }

    public function setState(int $state): self
    {
        $this->state = $state;

        return $this;
    }


}
