<?php


namespace App\Services;


class BaseService
{
    /** @var int */
    private $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }
}