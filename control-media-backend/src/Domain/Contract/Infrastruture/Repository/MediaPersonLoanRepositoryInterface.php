<?php

namespace App\Domain\Contract\Infrastruture\Repository;

use App\Domain\Entity\Media;
use App\Domain\Entity\MediaPersonLoan;
use App\Domain\ValueObject\MediaPaginatorVO;

interface MediaPersonLoanRepositoryInterface
{
    public function findAll(): array;
    public function getLastestMediaData(int $mediaId): ?MediaPersonLoan;
}