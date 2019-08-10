<?php


namespace App\Application\Service;


use App\Domain\Contract\Application\MediaPersonLoanApplicationServiceInterface;
use App\Domain\Entity\MediaPersonLoan;
use App\Domain\Service\MediaPersonLoanService;
use App\Domain\ValueObject\MediaPersonLoanVO;
use Exception;

class MediaPersonLoanApplicationService implements MediaPersonLoanApplicationServiceInterface
{
    /**
     * @var MediaPersonLoanService
     */
    private $mediaPersonLoanService;

    /**
     * MediaPersonLoanApplicationService constructor.
     * @param MediaPersonLoanService $mediaPersonLoanService
     */
    public function __construct(MediaPersonLoanService $mediaPersonLoanService)
    {

        $this->mediaPersonLoanService = $mediaPersonLoanService;
    }

    public function returnDataPersonPickedUpBookHandler(int $id) {
        return $this->mediaPersonLoanService->returnDataPersonPickedUpBookHandler($id);
    }

    /**
     * @param MediaPersonLoanVO $mediaPersonLoanVO
     * @return MediaPersonLoan
     * @throws Exception
     */
    public function createMediaPersonLoan(MediaPersonLoanVO $mediaPersonLoanVO)
    {
        return $this->mediaPersonLoanService->createMediaPersonLoan($mediaPersonLoanVO);
    }

    public function returnMediaPersonLoan(MediaPersonLoanVO $mediaPersonLoanVO): MediaPersonLoan
    {
        return $this->mediaPersonLoanService->returnMediaPersonLoan($mediaPersonLoanVO);
    }
}