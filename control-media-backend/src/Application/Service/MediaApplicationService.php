<?php

namespace App\Application\Service;

use App\Domain\Contract\Application\ConnectionApplicationInterface;
use App\Domain\Contract\Application\MediaApplicationServiceInterface;
use App\Domain\Entity\Media;
use App\Domain\Service\MediaService;
use App\Domain\ValueObject\MediaPaginatorVO;
use Exception;

class MediaApplicationService implements MediaApplicationServiceInterface
{
    /**
     * @var MediaService
     */
    private $media;
    /**
     * @var ConnectionApplicationInterface
     */
    private $connectionApplication;

    /**
     * MediaApplicationService constructor.
     * @param MediaService $media
     * @param ConnectionApplicationInterface $connectionApplication
     */
    public function __construct(
        MediaService $media,
        ConnectionApplicationInterface $connectionApplication
    ) {
        $this->media = $media;
        $this->connectionApplication = $connectionApplication;
    }

    public function findAllMedia(): array
    {
        return $this->media->findAllMedia();
    }

    public function findMedia(int $id): ?Media
    {
        return $this->media->findMedia($id);
    }

    /**
     * @param $media
     * @return Media|null
     * @throws Exception
     */
    public function createMedia($media): ?Media {
        try {
            $this->connectionApplication->beginTransaction();
            $mediaObject = $this->media->createMedia($media);
            $this->connectionApplication->commit();

            return $mediaObject;
        } catch (Exception $e) {
            $this->connectionApplication->rollback();
            throw $e;
        }
    }

    /**
     * @param $media
     * @return Media
     * @throws Exception
     */
    public function deleteMedia($media){
        try {
            $this->connectionApplication->beginTransaction();
            $mediaObject = $this->media->deleteMedia($media);
            $this->connectionApplication->commit();

            return $mediaObject;
        } catch (Exception $e) {
            $this->connectionApplication->rollback();
            throw $e;
        }
    }

    /**
     * @param $media
     * @return Media
     * @throws Exception
     */
    public function updateMedia($media) {
        try {
            $this->connectionApplication->beginTransaction();
            $mediaObject = $this->media->updateMedia($media);
            $this->connectionApplication->commit();

            return $mediaObject;
        } catch (Exception $e) {
            $this->connectionApplication->rollback();
            throw $e;
        }
    }

    /**
     * @param $firstResult
     * @param $maxResult
     * @param $columnOrder
     * @param $order
     * @return MediaPaginatorVO
     * @throws Exception
     */
    public function findBy($firstResult, $maxResult, $columnOrder, $order){
        return $this->media->findBy($firstResult,$maxResult,$columnOrder,$order);
    }

}
