<?php


namespace App\Application\Service;


use App\Domain\Contract\Application\MediaPersonLoanApplicationServiceInterface;
use App\Domain\Service\MediaPersonLoanService;

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

}