<?php

namespace App\Manager;

use App\Repository\ContactRepository;

class ContactManager
{
    /** @var ContactRepository */
    protected $repository;

    /**
     * @param ContactRepository $repository
     */
    public function __construct(ContactRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->findAll();
    }
}