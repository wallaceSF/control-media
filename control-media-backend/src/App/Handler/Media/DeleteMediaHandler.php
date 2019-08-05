<?php

namespace App\Handler\Media;

use App\BaseProject\BaseController;
use App\Service\MediaService;
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
     * MediaController constructor.
     * @param MediaService $mediaService
     */
    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return ResponseInterface
     */
    public function handle(Request $request, Response $response, array $args): ResponseInterface
    {
        $this->mediaService->deleteMedia($args['id']);
        return $response->withJSON([],201,JSON_PRETTY_PRINT);
    }
}