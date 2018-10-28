
<?php

namespace src\Integration;

class DataProvider
{
    private $host;
    private $user;
    private $password;

    /**
     * @param $host
     * @param $user
     * @param $password
     */
    public function __construct($host, $user, $password)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * @param array $request
     *
     * @return array
     */
    public function get(array $request)
    {
        // returns a response from external service
    }

    /**
     * For change host
     *
     * @param $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * For change user
     *
     * @param $user
     */
    public function setUser($user)
    {
        $this->host = $user;
    }

    /**
     * For change password
     *
     * @param $password
     */
    public function setPassword($password)
    {
        $this->host = $password;
    }
}

