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
     * @var \App\Entity\Person
     */
    private $person;

    private $returnedAt;


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

    /**
     * Set returnedAt.
     *
     * @param \DateTime $returnedAt
     *
     * @return MediaPersonLoan
     */
    public function setReturnedAt($returnedAt)
    {
        $this->returnedAt = $returnedAt;

        return $this;
    }

    /**
     * Get returnedAt.
     *
     * @return \DateTime
     */
    public function getReturnedAt()
    {
        return $this->returnedAt;
    }
}
