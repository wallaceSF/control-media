<?php

namespace App\Presentation\Handler\MediaPersonLoan;

use App\Application\Service\MediaPersonLoanApplicationService;
use App\BaseProject\BaseController;
use App\Domain\Service\MediaPersonLoanService;
use App\Domain\ValueObject\MediaPersonLoanVO;
use Exception;
use JsonMapper;
use JsonMapper_Exception;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class ReturnMediaPersonLoanHandler extends BaseController
{
    /**
     * @var MediaPersonLoanService
     */
    private $mediaService;

    /**
     * MediaController constructor.
     * @param MediaPersonLoanApplicationService $mediaService
     */
    public function __construct(MediaPersonLoanApplicationService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return ResponseInterface
     * @throws JsonMapper_Exception
     * @throws Exception
     */
    public function handle(Request $request, Response $response, array $args): ResponseInterface
    {
        /** @var MediaPersonLoanVO $mediaPersonLoanVO */
        $mediaPersonLoanVO = (new JsonMapper())->map(json_decode($request->getBody()->getContents()), new MediaPersonLoanVO());
        $this->mediaService->returnMediaPersonLoan($mediaPersonLoanVO);
        return $response->withJSON([],201,JSON_PRETTY_PRINT);
    }
}
