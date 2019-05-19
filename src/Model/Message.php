<?php


namespace App\Model;


use App\Application;

class Message
{

    /**
     * @var int id
     */
    private $id;

    /**
     * @var string message
     */
    private $message;

    /**
     * @var int sender_id
     */
    private $sender_id;

    /**
     * @var int receiver_id
     */
    private $receiver_id;

    /**
     * @var string created_at
     */
    private $created_at;

    /**
     * @var bool readed
     */
    private $readed;

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
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return Message
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return int
     */
    public function getSenderId()
    {
        return $this->sender_id;
    }

    /**
     * @param int $sender_id
     * @return Message
     */
    public function setSenderId($sender_id)
    {
        $this->sender_id = $sender_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getReceiverId()
    {
        return $this->receiver_id;
    }

    /**
     * @param int $receiver_id
     * @return Message
     */
    public function setReceiverId($receiver_id)
    {
        $this->receiver_id = $receiver_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param string $created_at
     * @return Message
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return bool
     */
    public function isReaded()
    {
        return $this->readed;
    }

    /**
     * @param bool $readed
     * @return Message
     */
    public function setReaded($readed)
    {
        $this->readed = $readed;
        return $this;
    }


    public function create() {
        $sql = "INSERT INTO message VALUES(null, ?, ?, ?, NOW(), 0)";
        $stmt = Application::getDatabase()->prepare($sql);
        $stmt->bind_param('sii', $this->message, $this->sender_id,
            $this->receiver_id);
        $stmt->execute();
        $this->id = $stmt->insert_id;
        $this->readed = 0;
    }

    public function findMessages($user1, $user2) {
        $sql = "SELECT * FROM message WHERE (receiver_id = $user1 AND sender_id = $user2)
                    OR (receiver_id = $user2 AND sender_id = $user1)";
        $result = Application::getDatabase()->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getMessages($user1, $user2, $message_id) {
        $sql = "SELECT * FROM message WHERE (receiver_id = $user1 AND sender_id = $user2 AND id > $message_id)";
        $result = Application::getDatabase()->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}