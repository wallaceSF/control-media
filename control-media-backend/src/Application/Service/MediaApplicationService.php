<?php

namespace App\Application\Service;

use App\Domain\Contract\Application\MediaApplicationServiceInterface;
use App\Domain\Service\MediaService;

class MediaApplicationService implements MediaApplicationServiceInterface
{
    /**
     * @var MediaService
     */
    private $media;

    public function __construct(MediaService $media)
    {
        $this->media = $media;
    }

    public function findAllMedia()
    {
        return $this->media->findAllMedia();
    }

    public function findMedia(int $id)
    {
        return $this->media->findMedia($id);
    }

    /**
     * @param $r
     * @return \App\Domain\Entity\Media|null
     * @throws \Exception
     */
    public function createMedia($r){
        return $this->media->createMedia($r);
    }

    /**
     * @param $r
     * @return \App\Domain\Entity\Media
     * @throws \Exception
     */
    public function deleteMedia($r){
        return $this->media->deleteMedia($r);
    }

    /**
     * @param $r
     * @return \App\Domain\Entity\Media
     * @throws \Exception
     */
    public function updateMedia($r){
        return $this->media->updateMedia($r);
    }

    /**
     * @param $firstResult
     * @param $maxResult
     * @param $columnOrder
     * @param $order
     * @return \App\Domain\Entity\Media
     * @throws \Exception
     */
    public function findBy($firstResult, $maxResult, $columnOrder, $order){
        return $this->media->updateMedia($firstResult,$maxResult,$columnOrder,$order);
    }
}