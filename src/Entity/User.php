<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity (repositoryClass="Repository\UserRepository")
 * @ORM\Table(name="users")
 */

class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $group_id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $last_name;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $email;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $phone;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $country_id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $salt;

    /**
     * @ORM\Column(type="boolean")
     * @var bool
     */
    protected $two_step;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $hash;

    private $password;

    public function __construct()
    {
        $this->setGroupId(1);
        $this->setName('');
        $this->setLastName('');
        $this->setEmail('');
        $this->setPhone('');
        $this->setTwoStep(false);
        $this->setSalt(token(8));

        $this->password = '';
        $this->hash = '';
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getGroupId(): int
    {
        return $this->group_id;
    }

    /**
     * @param int $group_id
     */
    public function setGroupId(int $group_id): void
    {
        $this->group_id = $group_id;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @param string $phone
     */
    /**
     * @return int
     */
    public function getCountryId(): int
    {
        return $this->country_id;
    }

    /**
     * @param int $country_id
     */
    public function setCountryId(int $country_id): void
    {
        $this->country_id = $country_id;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @throws \Exception
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
        $this->setHash();
    }

    /**
     * @return string
     */
    public function getSalt(): string
    {
        return $this->salt;
    }

    /**
     * @param string $salt
     */
    public function setSalt(string $salt): void
    {
        $this->salt = $salt;
    }

    /**
     * @return bool
     */
    public function isTwoStep(): bool
    {
        return $this->two_step;
    }

    /**
     * @param bool $two_step
     */
    public function setTwoStep(bool $two_step) {
        $this->two_step = $two_step;
    }

    public function setHash()
    {
        if (!empty($salt = $this->getSalt()) && !empty($pass = $this->getPassword())) {
            $this->hash = hash('sha512', $salt . $pass);
        } else {
            throw new \Exception('Error: You need set salt before getting hash!');
        }
    }

    public function getHash()
    {
        return $this->hash;
    }

}