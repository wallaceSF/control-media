<?php

namespace App\Domain\Contract\Infrastruture\Repository;

use App\Domain\Entity\Media;
use App\Domain\ValueObject\MediaPaginatorVO;

interface MediaRepositoryInterface
{
    public function findAllMediaWithPagination(
        int $firstResult,
        int $maxResults,
        string $columnOrder,
        string $order
    ): MediaPaginatorVO;

    public function findAll();

    public function find(int $id): ?Media;
    public function remove(Media $media);
    public function persist(Media $media);
}