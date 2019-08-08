<?php

namespace App\Infrastructure\Repository;

use App\Domain\Contract\Domain\DataBaseBuildInterface;
use App\Domain\Contract\Infrastruture\Repository\MediaPersonLoanRepositoryInterface;
use App\Domain\Entity\MediaPersonLoan;

class MediaPersonLoanRepository implements MediaPersonLoanRepositoryInterface
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

    public function findAll(): array {
        return $this->dataBaseBuildInterface->getRepository(MediaPersonLoan::class)->findAll();
    }

    public function getLastestMediaData($mediaId): ?MediaPersonLoan
    {
        /** @var MediaPersonLoan|null $mediaPersonLoan */
        $mediaPersonLoan = $this->dataBaseBuildInterface->getRepository(MediaPersonLoan::class)->findOneBy(
            ['media'=> $mediaId],
            ['returnedAt' => 'DESC']
        );

        return $mediaPersonLoan;
    }
}