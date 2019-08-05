<?php
/**
 * Created by PhpStorm.
 * User: wsferreira
 * Date: 27/07/19
 * Time: 18:10
 */

namespace App\Service;

use App\Entity\MediaPersonLoan;
use App\Entity\Person;
use App\ValueObject\InfoLoanVO;
use Doctrine\ORM\EntityManager;

class MediaPersonLoanService
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * MediaService constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return MediaPersonLoan[]|array
     */
    public function findAllMediaPersonLoan(): array
    {
        return $this->entityManager->getRepository(MediaPersonLoan::class)->findAll();
    }

    public function returnDataPersonPickedUpBookHandler(int $mediaId): ?InfoLoanVO
    {
        /** @var MediaPersonLoan $check */
        $check = $this->entityManager->getRepository(MediaPersonLoan::class)->findOneBy(
            ['media'=> $mediaId],
            ['returnedAt' => 'DESC']
        );

        $returnedAt = $check->getReturnedAt();
        if(!empty($check) && is_null($returnedAt)){
            $inforLoanVO = new InfoLoanVO();
            $inforLoanVO->person = $check->getPerson();
            $inforLoanVO->borrowed = true;
            return $inforLoanVO;
        }

        return null;
    }

}
