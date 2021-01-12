<?php


namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Session
 * @package Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="session")
 */
class Session
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var integer
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $session_id;
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $token;
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $session_name;
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $ip;
    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    protected $date_added;
    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    protected $date_modified;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getSessionId(): string
    {
        return $this->session_id;
    }

    /**
     * @param string $session_id
     */
    public function setSessionId(string $session_id): void
    {
        $this->session_id = $session_id;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getSessionName(): string
    {
        return $this->session_name;
    }

    /**
     * @param string $session_name
     */
    public function setSessionName(string $session_name): void
    {
        $this->session_name = $session_name;
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     */
    public function setIp(string $ip): void
    {
        $this->ip = $ip;
    }

    /**
     * @return \DateTime
     */
    public function getDateAdded(): \DateTime
    {
        return $this->date_added;
    }

    /**
     * @param \DateTime $date_added
     */
    public function setDateAdded(\DateTime $date_added): void
    {
        $this->date_added = $date_added;
    }

    /**
     * @return \DateTime
     */
    public function getDateModified(): \DateTime
    {
        return $this->date_modified;
    }

    /**
     * @param \DateTime $date_modified
     */
    public function setDateModified(\DateTime $date_modified): void
    {
        $this->date_modified = $date_modified;
    }


}