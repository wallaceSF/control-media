<?php

namespace App\Domain\ValueObject;

use App\Domain\Entity\Person;

class InfoLoanVO
{
    /**
     * @var Person
     */
    public $person;
    public $borrowed;
}
