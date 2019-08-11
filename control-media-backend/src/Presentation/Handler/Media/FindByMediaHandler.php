<?php

namespace App\Presentation\Handler\Media;

use App\Application\Service\MediaApplicationService;
use App\BaseProject\BaseController;
use App\Domain\Entity\Media;
use JMS\Serializer\SerializerBuilder;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class FindByMediaHandler extends BaseController
{
    /**
     * @var MediaApplicationService
     */
    private $mediaService;

    /**
     * FindByMediaHandler constructor.
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
        /** @var Media[] $listMedia */
        $listMedia = $this->mediaService->findBy($args['firstResult'],$args['maxResult'],$args['columnOrder'],$args['order']);

        $serializer = SerializerBuilder::create()->build();
        $listMediaArray = json_decode($serializer->serialize($listMedia, 'json'),true);

        return $response->withJSON($listMediaArray, 200, JSON_PRETTY_PRINT);
    }
}
