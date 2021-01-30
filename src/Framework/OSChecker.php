<?php

namespace Framework;

class OSChecker implements \Stringable
{
    const OS_WIN = 'Windows';
    const OS_WIN_NT = 'WINNT'; //my windows 10 writes WINNT xD
    const OS_BSD = 'BSD';
    const OS_DARWIN = 'Darwin';
    const OS_SOLARIS = 'Solaris';
    const OS_LINUX = 'Linux';
    const OS_UNKNOWN = 'Unknown';

    /**
     * @var string
     */
    private $_os;

    public function __construct()
    {
        $this->_os = PHP_OS;
    }

    public function getOS(): string
    {
        return $this->_os;
    }

    public function __toString(): string
    {
        return $this->getOS();
    }

}