<?php

namespace App\Presentation\Handler\MediaPersonLoan;

use App\Application\Service\MediaPersonLoanApplicationService;
use App\BaseProject\BaseController;
use App\Domain\Service\MediaPersonLoanService;
use App\Domain\ValueObject\InfoLoanVO;
use JMS\Serializer\SerializerBuilder;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class ReturnDataPersonPickedUpBookHandler extends BaseController
{
    /**
     * @var MediaPersonLoanService
     */
    private $mediaPersonLoanService;

    public function __construct(MediaPersonLoanApplicationService $mediaPersonLoanService)
    {
        $this->mediaPersonLoanService = $mediaPersonLoanService;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return ResponseInterface
     */
    public function handle(Request $request, Response $response, array $args): ResponseInterface
    {
        /** @var InfoLoanVO|null $listMedia */
        $infoLoanVO = $this->mediaPersonLoanService->returnDataPersonPickedUpBookHandler($args['mediaId']);

        if(is_null($infoLoanVO)){
            $infoLoanVO = [];
        }

        $serializer = SerializerBuilder::create()->build();
        $infoLoanVOArray = json_decode($serializer->serialize($infoLoanVO, 'json'),true);

        return $response->withJSON($infoLoanVOArray, 200, JSON_PRETTY_PRINT);
    }
}
