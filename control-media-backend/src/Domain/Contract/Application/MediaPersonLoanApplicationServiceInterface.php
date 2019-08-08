<?php


namespace App\Domain\Contract\Application;

interface MediaPersonLoanApplicationServiceInterface
{
    public function returnDataPersonPickedUpBookHandler(int $id);

}