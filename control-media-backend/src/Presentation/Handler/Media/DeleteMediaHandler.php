<?php

namespace App\Presentation\Handler\Media;

use App\Application\Service\MediaApplicationService;
use App\BaseProject\BaseController;
use App\Domain\Service\MediaService;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class DeleteMediaHandler extends BaseController
{
    /**
     * @var MediaService
     */
    private $mediaService;

    /**
     * DeleteMediaHandler constructor.
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
     * @throws \Exception
     */
    public function handle(Request $request, Response $response, array $args): ResponseInterface
    {
        $this->mediaService->deleteMedia($args['id']);
        return $response->withJSON([],201,JSON_PRETTY_PRINT);
    }
}
