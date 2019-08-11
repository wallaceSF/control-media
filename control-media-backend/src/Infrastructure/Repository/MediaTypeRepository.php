<?php

namespace App\Infrastructure\Repository;

use App\Domain\Contract\Domain\DataBaseBuildInterface;
use App\Domain\Contract\Infrastruture\Repository\MediaTypeRepositoryInterface;
use App\Domain\Entity\MediaType;

class MediaTypeRepository implements MediaTypeRepositoryInterface
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

    public function find(int $id): ?MediaType
    {
        /** @var MediaType $mediaObject */
        $mediaObject = $this->dataBaseBuildInterface->getRepository(MediaType::class)->find($id);
        return $mediaObject;
    }
}