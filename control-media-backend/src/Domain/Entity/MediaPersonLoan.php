<?php

namespace App\Domain\Entity;

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
     * @var Media
     */
    private $media;

    /**
     * @var Person
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
     * @param Media|null $media
     *
     * @return MediaPersonLoan
     */
    public function setMedia(Media $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media.
     *
     * @return Media|null
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set person.
     *
     * @param Person|null $person
     *
     * @return MediaPersonLoan
     */
    public function setPerson(Person $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person.
     *
     * @return Person|null
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
