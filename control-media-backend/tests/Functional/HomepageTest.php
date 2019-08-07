<?php

namespace Tests\Functional;

use App\Domain\Service\MediaService;
use App\Domain\ValueObject\MediaVO;

class HomepageTest extends BaseTestCase
{
    public function testCreatedMedia()
    {
        $entityManager = $this->createEntityManager();
        $mediaService = new MediaService($entityManager);

        $mediaVO = new MediaVO();
        $mediaVO->title = 'my book';
        $mediaVO->description = 'my description';
        $mediaVO->type = 3;
        $mediaObject = $mediaService->createMedia($mediaVO);

        $this->assertEquals($mediaVO->title, $mediaObject->getTitle());
    }

    public function testUpdateMedia()
    {
        $entityManager = $this->createEntityManager();
        $mediaService = new MediaService($entityManager);

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
        $entityManager = $this->createEntityManager();
        $mediaService = new MediaService($entityManager);

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
        $entityManager = $this->createEntityManager();
        $mediaService = new MediaService($entityManager);
        $mediaArrayObject = $mediaService->findAllMedia();

        $this->assertIsArray($mediaArrayObject, 'Is array object');
    }

    public function testFindMedia()
    {
        $entityManager = $this->createEntityManager();
        $mediaService = new MediaService($entityManager);

        $mediaVOInsert = new MediaVO();
        $mediaVOInsert->title = 'my insert will delete';
        $mediaVOInsert->description = 'my description';
        $mediaVOInsert->type = 1;
        $mediaObjectInsert = $mediaService->createMedia($mediaVOInsert);

        $mediaObject = $mediaService->findMedia($mediaObjectInsert->getId());

        $this->assertIsObject($mediaObject, 'Is object');
    }
}
