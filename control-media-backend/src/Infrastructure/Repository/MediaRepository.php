<?php

namespace App\Infrastructure\Repository;

use App\Domain\Contract\Domain\DataBaseBuildInterface;
use App\Domain\Contract\Infrastruture\Repository\MediaRepositoryInterface;
use App\Domain\Entity\Media;
use App\Domain\ValueObject\MediaPaginatorVO;
use App\Domain\ValueObject\MediaVO;
use Doctrine\ORM\Tools\Pagination\Paginator;

class MediaRepository implements MediaRepositoryInterface
{
    /**
     * @var DataBaseBuildInterface
     */
    private $dataBaseBuildInterface;

    /**
     * MediaRepository constructor.
     * @param DataBaseBuildInterface $dataBaseBuildInterface
     */
    public function __construct(DataBaseBuildInterface $dataBaseBuildInterface)
    {
        $this->dataBaseBuildInterface = $dataBaseBuildInterface;
    }

    /**
     * @param int $firstResult
     * @param int $maxResults
     * @param string $columnOrder
     * @param string $order
     * @return MediaPaginatorVO
     * @throws \Exception
     */
    public function findAllMediaWithPagination(
        int $firstResult = 1,
        int $maxResults = 10,
        $columnOrder = 'media-id',
        $order = 'asc'
    ): MediaPaginatorVO {

        $mediaPaginatorVO = new MediaPaginatorVO();
        if(!isset($mediaPaginatorVO->columnOrder[$columnOrder])){
            throw new \Exception('coluna não permitida', 400);
        }

        if($firstResult == 0) {
            $firstResult = 1;
        }

        $offset = $maxResults * ($firstResult - 1);

        $qb = $this->dataBaseBuildInterface->getEntityManager()->createQueryBuilder();
        $qb = $qb
            ->select('media')
            ->from('App\Domain\Entity\Media', 'media')
            ->join('media.type', 'type')
            ->orderBy($mediaPaginatorVO->columnOrder[$columnOrder], $order)
            ->setFirstResult($offset)
            ->setMaxResults($maxResults);

        /** @var Media[]|Paginator $paginatorMedia */
        $paginatorMedia = new Paginator($qb, $fetchJoinCollection = true);

        $listMediaVO = [];
        foreach ($paginatorMedia as $media) {
            $mediaVO = new MediaVO();
            $mediaVO->id = $media->getId();
            $mediaVO->title = $media->getTitle();
            $mediaVO->description = $media->getDescription();
            $mediaVO->type = $media->getType();

            $listMediaVO[] = $mediaVO;
        }

        $mediaPaginatorVO->mediaVO = $listMediaVO;
        $mediaPaginatorVO->currentFirst = $firstResult;
        $mediaPaginatorVO->currentMax = $maxResults;
        $mediaPaginatorVO->total = $paginatorMedia->count();

        return $mediaPaginatorVO;
    }

    /**
     * @return Media[]
     */
    public function findAll(): array
    {
        return $this->dataBaseBuildInterface->getRepository(Media::class)->findAll();
    }

    public function find(int $id): ?Media
    {
        /** @var Media $mediaObject */
        $mediaObject = $this->dataBaseBuildInterface->getRepository(Media::class)->find($id);
        return $mediaObject;
    }

    public function remove(Media $media): Media
    {
        $this->dataBaseBuildInterface->remove($media);
        $this->dataBaseBuildInterface->flush();

        return $media;
    }

    public function persist(Media $media): Media
    {
        $this->dataBaseBuildInterface->persist($media);
        $this->dataBaseBuildInterface->flush();

        return $media;
    }
}