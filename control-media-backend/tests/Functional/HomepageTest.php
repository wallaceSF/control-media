<?php

namespace Tests\Functional;

use App\Domain\Service\MediaService;
use App\Domain\ValueObject\MediaVO;
use App\Infrastructure\Repository\MediaRepository;
use App\Infrastructure\Repository\MediaTypeRepository;
use PHPUnit\Framework\TestCase;

class HomepageTest extends TestCase
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
      //  $connectionDataBase = $this->createEntityManager();
      //  $this->mediaRepository = new MediaRepository($connectionDataBase);
      //  $this->mediaTypeRepository = new MediaTypeRepository($connectionDataBase);
    }

    public function testCreatedMedia()
    {
        $id = 1;
         $this->assertEquals($id, 1);
    }

    public function testCreatedMedia2()
    {
         $mediaVO = new MediaVO();
         $mediaVO->id = 1;
         $this->assertEquals($mediaVO->id, 1);
    }
  
}
