<?php

namespace App\Entity;

/**
 * MediaStatusLoan
 */
class MediaStatusLoan
{
    /**
     * @var string
     */
    private $description;

    /**
     * @var int
     */
    private $id;


    /**
     * Set description.
     *
     * @param string $description
     *
     * @return MediaStatusLoan
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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
}
