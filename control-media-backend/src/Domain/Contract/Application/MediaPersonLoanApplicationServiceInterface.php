<?php


namespace App\Domain\Contract\Application;

use App\Domain\ValueObject\MediaPersonLoanVO;

interface MediaPersonLoanApplicationServiceInterface
{
    public function returnDataPersonPickedUpBookHandler(int $id);
    public function createMediaPersonLoan(MediaPersonLoanVO $mediaPersonLoanVO);

}