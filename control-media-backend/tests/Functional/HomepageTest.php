<?php

namespace Tests\Functional;

use App\Domain\Service\MediaService;
use App\Domain\ValueObject\MediaVO;
use App\Infrastructure\Repository\MediaRepository;
use App\Infrastructure\Repository\MediaTypeRepository;

class HomepageTest extends BaseTestCase
{
    /**
     * @var MediaRepository
     */
    public $mediaRepository;
    /**
     * @var MediaTypeRepository
     */
    public $mediaTypeRepository;

    /**
     * HomepageTest constructor.
     */
    public function setUp(): void
    {
        $connectionDataBase = $this->createEntityManager();
        $this->mediaRepository = new MediaRepository($connectionDataBase);
        $this->mediaTypeRepository = new MediaTypeRepository($connectionDataBase);
    }

    public function testOjectMediaRepository()
    {
        $this->assertInstanceOf(MediaRepository::class, $this->mediaRepository);
    }

    public function testOjectMediaTypeRepository()
    {
        $this->assertInstanceOf(MediaTypeRepository::class, $this->mediaTypeRepository);
    }

    public function testCreatedMedia()
    {
        $mediaService = new MediaService($this->mediaRepository, $this->mediaTypeRepository);

        $mediaVO = new MediaVO();
        $mediaVO->title = 'my book';
        $mediaVO->description = 'my description';
        $mediaVO->type = 3;
        $mediaObject = $mediaService->createMedia($mediaVO);

        $this->assertEquals($mediaVO->title, $mediaObject->getTitle());
    }

    public function testUpdateMedia()
    {
        $mediaService = new MediaService($this->mediaRepository, $this->mediaTypeRepository);

        $mediaVOInsert = new MediaVO();
        $mediaVOInsert->title = 'my insert title';
        $mediaVOInsert->description = 'my description';
        $mediaVOInsert->type = 3;
        $mediaObjectInsert = $mediaService->createMedia($mediaVOInsert);

        $mediaVO = new MediaVO();
        $mediaVO->title = 'my title test update';
        $mediaVO->description = 'my description';
        $mediaVO->type = 2;
        $mediaVO->id = $mediaObjectInsert->getId();
        $mediaObject = $mediaService->updateMedia($mediaVO);

        $this->assertEquals($mediaVO->title, $mediaObject->getTitle());
    }


    public function testDeleteMedia()
    {
        $mediaService = new MediaService($this->mediaRepository, $this->mediaTypeRepository);
        $mediaVOInsert = new MediaVO();
        $mediaVOInsert->title = 'my insert will delete';
        $mediaVOInsert->description = 'my description';
        $mediaVOInsert->type = 3;
        $mediaObjectInsert = $mediaService->createMedia($mediaVOInsert);

        $mediaObject = $mediaService->deleteMedia($mediaObjectInsert->getId());

        $this->assertEquals($mediaVOInsert->title, $mediaObject->getTitle());
    }

    public function testFindAllMedia()
    {
        $mediaService = new MediaService($this->mediaRepository, $this->mediaTypeRepository);
        $mediaArrayObject = $mediaService->findAllMedia();

        $this->assertIsArray($mediaArrayObject, 'Is array object');
    }

    public function testFindMedia()
    {
        $mediaService = new MediaService($this->mediaRepository, $this->mediaTypeRepository);
        $mediaVOInsert = new MediaVO();
        $mediaVOInsert->title = 'my insert will delete';
        $mediaVOInsert->description = 'my description';
        $mediaVOInsert->type = 1;
        $mediaObjectInsert = $mediaService->createMedia($mediaVOInsert);

        $mediaObject = $mediaService->findMedia($mediaObjectInsert->getId());

        $this->assertIsObject($mediaObject, 'Is object');
    }
}
