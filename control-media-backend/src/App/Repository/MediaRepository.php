<?php

namespace App\Repository;

use App\Entity\Media;
use App\ValueObject\MediaPaginatorVO;
use App\ValueObject\MediaVO;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class MediaRepository extends EntityRepository
{
    /**
     * @param int $firstResult
     * @param int $maxResults
     * @param string $columnOrder
     * @param string $order
     * @return MediaPaginatorVO
     * @throws \Exception
     */
    public function findAllMediaWithPagination(int $firstResult = 0, int $maxResults = 10, $columnOrder = 'media-id', $order = 'asc'): MediaPaginatorVO {

        $mediaPaginatorVO = new MediaPaginatorVO();
        if(!isset($mediaPaginatorVO->columnOrder[$columnOrder])){
            throw new \Exception('coluna não permitida', 400);
        }

        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb = $qb
            ->select('media')
            ->from('App\Entity\Media', 'media')
            ->join('media.type', 'type')
            ->orderBy($mediaPaginatorVO->columnOrder[$columnOrder], $order)
            ->setFirstResult($firstResult)
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

}