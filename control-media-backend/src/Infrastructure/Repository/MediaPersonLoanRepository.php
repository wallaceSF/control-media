<?php

namespace App\Infrastructure\Repository;

use App\Domain\Contract\Domain\DataBaseBuildInterface;
use App\Domain\Contract\Infrastruture\Repository\MediaPersonLoanRepositoryInterface;
use App\Domain\Entity\MediaPersonLoan;
use App\Domain\ValueObject\MediaPersonLoanVO;
use Doctrine\ORM\Query\ResultSetMappingBuilder;

class MediaPersonLoanRepository implements MediaPersonLoanRepositoryInterface
{
    /**
     * @var DataBaseBuildInterface
     */
    private $dataBaseBuild;

    /**
     * MediaRepository constructor.
     * @param DataBaseBuildInterface $dataBaseBuild
     */
    public function __construct(DataBaseBuildInterface $dataBaseBuild)
    {
        $this->dataBaseBuild = $dataBaseBuild;
    }

    public function findAll(): array {
        return $this->dataBaseBuild->getRepository(MediaPersonLoan::class)->findAll();
    }

    public function getLastestMediaData($mediaId): ?MediaPersonLoan
    {
        $sql = "SELECT * FROM media_person_loan where media = ? ORDER BY CASE WHEN returned_at IS NULL THEN 1 ELSE 0 END DESC, id desc, returned_at DESC limit 100 ";
         
        $conn = $this->dataBaseBuild->getEntityManager()
            ->getConnection();       
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $mediaId);
        $stmt->execute();
        $id = $stmt->fetchAll();

        /** @var MediaPersonLoan|null $mediaPersonLoan */
        $mediaPersonLoan = $this->dataBaseBuild->getRepository(MediaPersonLoan::class)->findOneBy(
            ['media'=> $mediaId, 'id' => $id[0]['id']],
            ['returnedAt' => 'DESC']
        );

        return $mediaPersonLoan;
    }

    public function persist(MediaPersonLoan $media): MediaPersonLoan
    {
        $this->dataBaseBuild->persist($media);
        $this->dataBaseBuild->flush();

        return $media;
    }

    public function findByPersonAndMedia(MediaPersonLoanVO $mediaPersonLoanVO): ?MediaPersonLoan
    {
        $sql = "SELECT * FROM media_person_loan where media = ? ORDER BY CASE WHEN returned_at IS NULL THEN 1 ELSE 0 END DESC, id desc, returned_at DESC limit 100 ";
         
        $conn = $this->dataBaseBuild->getEntityManager()
            ->getConnection();       
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $mediaPersonLoanVO->media);
        $stmt->execute();
        $id = $stmt->fetchAll();

        /** @var MediaPersonLoan|null $mediaPersonLoan */
        $mediaPersonLoan = $this->dataBaseBuild->getRepository(MediaPersonLoan::class)->findOneBy(
            ['media'=> $mediaPersonLoanVO->media, 'id' => $id[0]['id']],
            ['id' => 'DESC']
        );

        return $mediaPersonLoan;
    }
}
