<?php

namespace App\Handler;

use App\BaseProject\BaseController;
use App\Service\MediaService;
use App\ValueObject\MediaVO;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
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
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws JsonMapper_Exception
     */
    public function handle(Request $request, Response $response, array $args): ResponseInterface
    {
        /** @var MediaVO $mediaVO */
        $mediaVO = (new JsonMapper())->map(json_decode($request->getBody()->getContents()), new MediaVO());
        $this->mediaService->createMedia($mediaVO);
        return $response->withJSON([],201,JSON_PRETTY_PRINT);
    }
}
