<?php

namespace App\Presentation\Handler\Media;

use App\Application\Service\MediaApplicationService;
use App\BaseProject\BaseController;
use App\Domain\Service\MediaService;
use App\Domain\ValueObject\MediaVO;
use Exception;
use JsonMapper;
use JsonMapper_Exception;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class CreateMediaHandler extends BaseController
{
    /**
     * @var MediaService
     */
    private $mediaService;

    /**
     * CreateMediaHandler constructor.
     * @param MediaApplicationService $mediaService
     */
    public function __construct(MediaApplicationService $mediaService)
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
        /** @var MediaVO $mediaVO */
        $mediaVO = (new JsonMapper())->map(json_decode($request->getBody()->getContents()), new MediaVO());
        $this->mediaService->createMedia($mediaVO);
        return $response->withJSON([],201,JSON_PRETTY_PRINT);
    }
}
