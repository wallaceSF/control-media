<?php

namespace App\Handler\Media;

use App\BaseProject\BaseController;
use App\Service\MediaService;

use JMS\Serializer\SerializerBuilder;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class FindMediaHandler extends BaseController
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
        $mediaObject = $this->mediaService->findMedia($args['id']);

        $serializer = SerializerBuilder::create()->build();
        $mediaArray = json_decode($serializer->serialize($mediaObject, 'json'),true);

        return $response->withJSON($mediaArray,200,JSON_PRETTY_PRINT);
    }
}