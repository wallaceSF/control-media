<?php

namespace App\Handler\Media;

use App\BaseProject\BaseController;
use App\Entity\Media;
use App\Service\MediaService;

use JMS\Serializer\SerializerBuilder;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class FindByMediaHandler extends BaseController
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
        /** @var Media[] $listMedia */
        $listMedia = $this->mediaService->findBy($args['firstResult'],$args['maxResult'],$args['columnOrder'],$args['order']);

        $serializer = SerializerBuilder::create()->build();
        $listMediaArray = json_decode($serializer->serialize($listMedia, 'json'),true);

        return $response->withJSON($listMediaArray, 200, JSON_PRETTY_PRINT);
    }
}
