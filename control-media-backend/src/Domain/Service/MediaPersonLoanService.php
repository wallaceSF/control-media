<?php
/**
 * Created by PhpStorm.
 * User: wsferreira
 * Date: 27/07/19
 * Time: 18:10
 */

namespace App\Domain\Service;

use App\Domain\Contract\Infrastruture\Repository\MediaPersonLoanRepositoryInterface;
use App\Domain\Entity\MediaPersonLoan;
use App\Domain\ValueObject\InfoLoanVO;

class MediaPersonLoanService
{
    /**
     * @var MediaPersonLoanRepositoryInterface
     */
    private $mediaPersonLoanRepository;

    public function __construct(MediaPersonLoanRepositoryInterface $mediaPersonLoanRepository)
    {
        $this->mediaPersonLoanRepository = $mediaPersonLoanRepository;
    }

    /**
     * @return MediaPersonLoan[]|array
     */
    public function findAllMediaPersonLoan(): array
    {
        return $this->mediaPersonLoanRepository->findAll();
    }

    public function returnDataPersonPickedUpBookHandler(int $mediaId): ?InfoLoanVO
    {
        /** @var MediaPersonLoan $check */
        $mediaPersonLoan = $this->mediaPersonLoanRepository->getLastestMediaData($mediaId);

        if(is_null($mediaPersonLoan)){
            return null;
        }

        $returnedAt = $mediaPersonLoan->getReturnedAt();
        if(!empty($mediaPersonLoan) && is_null($returnedAt)){
            $inforLoanVO = new InfoLoanVO();
            $inforLoanVO->person = $mediaPersonLoan->getPerson();
            $inforLoanVO->borrowed = true;
            return $inforLoanVO;
        }

        return null;
    }
}
