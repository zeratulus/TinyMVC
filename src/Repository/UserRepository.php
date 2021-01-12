<?php


namespace Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function getAllAdminUsers()
    {
        return $this->_em->createQuery('SELECT u FROM Entity\User u WHERE u.group_id = "777"')->getResult();
    }

    public function isEmailExists(string $email)
    {
        return !empty($this->_em->createQuery("SELECT u FROM Entity\User u WHERE u.email = '{$email}'")->getResult());
    }

    public function isPhoneExists(string $phone)
    {
        return !empty($this->_em->createQuery("SELECT u FROM Entity\User u WHERE u.phone = '{$phone}'")->getResult());
    }

    public function login($email, $password)
    {
        $user = $this->_em->createQuery("SELECT u FROM Entity\User u WHERE u.email = '{$email}'")->getSingleResult();
        $result = $this->_em->createQuery("SELECT u FROM Entity\User u WHERE u.email = '{$email}' AND u.hash = '".hash('sha512', $user->getSalt() . $password). "'")->getResult();
        return !empty($result);
    }

    public function getLoggedUser($email, $password)
    {
        $user = $this->_em->createQuery("SELECT u FROM Entity\User u WHERE u.email = '{$email}'")->getSingleResult();
        $result = $this->_em->createQuery("SELECT u FROM Entity\User u WHERE u.email = '{$email}' AND u.hash = '".hash('sha512', $user->getSalt() . $password). "'")->getSingleResult();
        return $result;
    }

}