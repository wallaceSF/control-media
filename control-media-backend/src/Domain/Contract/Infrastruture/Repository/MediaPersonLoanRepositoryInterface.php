<?php

namespace App\Domain\Contract\Infrastruture\Repository;

use App\Domain\Entity\Media;
use App\Domain\Entity\MediaPersonLoan;
use App\Domain\ValueObject\MediaPaginatorVO;
use App\Domain\ValueObject\MediaPersonLoanVO;

interface MediaPersonLoanRepositoryInterface
{
    public function findAll(): array;
    public function getLastestMediaData(int $mediaId): ?MediaPersonLoan;
    public function persist(MediaPersonLoan $mediaObject): MediaPersonLoan;
    public function findByPersonAndMedia(\App\Domain\ValueObject\MediaPersonLoanVO $mediaPersonLoanVO): ?MediaPersonLoan;
    public function findBy(array $array): array;
}