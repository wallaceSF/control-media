<?php

namespace App\Domain\Entity;

use DateTime;
use Exception;

/**
 * Media
 */
class Media
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var DateTime|null
     */
    private $registrationDate;

    /**
     * @var int
     */
    private $id;

    /**
     * @var MediaType
     */
    private $type;

    public function __construct()
    {
        $this->registrationDate = new DateTime();
    }


    /**
     * Set title.
     *
     * @param string $title
     *
     * @return Media
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description.
     *
     * @param string|null $description
     *
     * @return Media
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set registrationDate.
     *
     * @param DateTime|null $registrationDate
     * @return Media
     * @throws Exception
     */
    public function setRegistrationDate(?DateTime $registrationDate = null)
    {
        $this->registrationDate = is_null($registrationDate) ?? new DateTime();

        return $this;
    }

    /**
     * Get registrationDate.
     *
     * @return DateTime|null
     */
    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type.
     *
     * @param MediaType|null $type
     *
     * @return Media
     */
    public function setType(MediaType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return MediaType|null
     */
    public function getType()
    {
        return $this->type;
    }
}
