<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @property  roles
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 *     fields={"Email"},
 *     message= "L'email que vous avez indiqué est déjà utilisé !"
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", unique=true)
     *
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $Firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Lastname;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $Phone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(strict=true)
     *
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=8)
     *
     *
     */
    private $Password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="user")
     */
    private $Annonce;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Role;

    public function __construct()
    {
        $this->Annonce = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->Firstname;
    }

    public function setFirstname(string $Firstname): self
    {
        $this->Firstname = $Firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->Lastname;
    }

    public function setLastname(string $Lastname): self
    {
        $this->Lastname = $Lastname;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->Phone;
    }

    public function setPhone(string $Phone): self
    {
        $this->Phone = $Phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(string $Password): self
    {
        $this->Password = $Password;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getAnnonce(): Collection
    {
        return $this->Annonce;
    }

    public function addAnnonce(Product $annonce): self
    {
        if (!$this->Annonce->contains($annonce)) {
            $this->Annonce[] = $annonce;
            $annonce->setUser($this);
        }

        return $this;
    }

    public function removeAnnonce(Product $annonce): self
    {
        if ($this->Annonce->contains($annonce)) {
            $this->Annonce->removeElement($annonce);
            // set the owning side to null (unless already changed)
            if ($annonce->getUser() === $this) {
                $annonce->setUser(null);
            }
        }

        return $this;
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     * @return mixed
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function removeRole($role)
    {
        $index = array_search ($role, $this->roles, true);
        if ($index !== false) {
            array_splice ($this->roles, $index, 1);
        }
    }

    public function getRole(): ?string
    {
        return $this->Role;
    }

    public function setRole(string $Role): self
    {
        $this->Role = $Role;

        return $this;
    }
}
