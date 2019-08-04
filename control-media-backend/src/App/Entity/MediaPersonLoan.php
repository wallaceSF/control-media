<?php

namespace App\Entity;

/**
 * MediaPersonLoan
 */
class MediaPersonLoan
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \App\Entity\Media
     */
    private $media;

    /**
     * @var \App\Entity\MediaStatusLoan
     */
    private $status;

    /**
     * @var \App\Entity\Person
     */
    private $person;


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
     * Set media.
     *
     * @param \App\Entity\Media|null $media
     *
     * @return MediaPersonLoan
     */
    public function setMedia(\App\Entity\Media $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media.
     *
     * @return \App\Entity\Media|null
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set status.
     *
     * @param \App\Entity\MediaStatusLoan|null $status
     *
     * @return MediaPersonLoan
     */
    public function setStatus(\App\Entity\MediaStatusLoan $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return \App\Entity\MediaStatusLoan|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set person.
     *
     * @param \App\Entity\Person|null $person
     *
     * @return MediaPersonLoan
     */
    public function setPerson(\App\Entity\Person $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person.
     *
     * @return \App\Entity\Person|null
     */
    public function getPerson()
    {
        return $this->person;
    }
}
