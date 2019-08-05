<?php

namespace App\Handler\Media;

use App\BaseProject\BaseController;
use App\Entity\Person;
use App\Service\MediaPersonLoanService;

use App\ValueObject\InfoLoanVO;
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

    /**
     * MediaController constructor.
     * @param MediaPersonLoanService $mediaPersonLoanService
     */
    public function __construct(MediaPersonLoanService $mediaPersonLoanService)
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

        $serializer = SerializerBuilder::create()->build();
        $infoLoanVOArray = json_decode($serializer->serialize($infoLoanVO, 'json'),true);

        return $response->withJSON($infoLoanVOArray, 200, JSON_PRETTY_PRINT);
    }
}
