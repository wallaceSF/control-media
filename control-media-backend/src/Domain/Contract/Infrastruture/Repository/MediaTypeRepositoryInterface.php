<?php

namespace App\Domain\Contract\Infrastruture\Repository;

use App\Domain\Entity\Media;
use App\Domain\Entity\MediaType;
use App\Domain\ValueObject\MediaPaginatorVO;

interface MediaTypeRepositoryInterface
{
    public function find(int $id): ?MediaType;
}