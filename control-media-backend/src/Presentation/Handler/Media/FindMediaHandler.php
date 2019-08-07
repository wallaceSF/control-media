<?php

namespace App\Presentation\Handler\Media;

use App\Application\Service\MediaApplicationService;
use App\BaseProject\BaseController;
use JMS\Serializer\SerializerBuilder;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class FindMediaHandler extends BaseController
{
    /**
     * @var MediaApplicationService
     */
    private $mediaService;

    public function __construct(MediaApplicationService $mediaService)
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

        if(is_null($mediaObject)){
            $mediaObject = [];
        }

        $serializer = SerializerBuilder::create()->build();
        $mediaArray = json_decode($serializer->serialize($mediaObject, 'json'),true);

        return $response->withJSON($mediaArray,200,JSON_PRETTY_PRINT);
    }
}