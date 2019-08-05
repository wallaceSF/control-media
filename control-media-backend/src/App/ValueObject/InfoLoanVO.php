<?php

namespace App\ValueObject;

use App\Entity\Person;

class InfoLoanVO
{
    /**
     * @var Person
     */
    public $person;
    public $borrowed;
}
