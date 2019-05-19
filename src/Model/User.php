<?php


namespace App\Model;


use App\Application;

class User
{

    /**
     * @var int id
     */
    private $id;

    /**
     * @var string username
     */
    private $username;

    /**
     * @var string $password
     */
    private $password;

    /**
     * @var datetime lastConnect
     */
    private $last_connect_date;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return datetime
     */
    public function getLastConnect()
    {
        return $this->last_connect_date;
    }

    /**
     * @param datetime $lastConnect
     * @return User
     */
    public function setLastConnect($lastConnect)
    {
        $this->last_connect_date = $lastConnect;
        return $this;
    }

    public function create() {
        $sql = "INSERT INTO user VALUES(null, ?, ?, '".date('Y-m-d H:i:s')."')";
        $stmt = Application::getDatabase()->prepare($sql);
        $stmt->bind_param('ss', $this->username, $this->password);
        $stmt->execute();
        $this->id = $stmt->insert_id;
        $this->lastConnect = date('Y-m-d H:i:s');
    }

    public function findByUsername($username) {
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $result = Application::getDatabase()->query($sql);
        return $result->fetch_object(User::class);
    }

    public function findUsers() {
        $sql = "SELECT * FROM user ORDER BY username";
        $result = Application::getDatabase()->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateConnexion() {
        $sql = "UPDATE user set last_connect_date = '".date('Y-m-d H:i:s')."' WHERE id = {$this->id}";
        Application::getDatabase()->query($sql);
    }

}