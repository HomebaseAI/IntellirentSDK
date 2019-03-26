<?php

namespace IntellirentSDK\Models;

class NewPropertyResponse extends AbstractModel
{
    /**
     * @var $id
     */
    private $id;

    /**
     * @var $invite_link
     */
    private $invite_link;

    /**
     * @var status
     */
    private $status;

    public function __construct(int $id, string $inviteLink, string $status)
    {
        $this->id = $id;
        $this->invite_link = $inviteLink;
        $this->status = $status;
    }

    /**
     * get $id
     * 
     * @return int
     */
    public function getID()
    {
        return $this->id;
    }

    /**
     * get $invite_link
     * 
     * @return string
     */
    public function getInviteLink()
    {
        return $this->invite_link;
    }

    /**
     * get $status
     * 
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
}