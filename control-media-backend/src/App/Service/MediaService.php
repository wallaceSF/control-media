<?php
/**
 * Created by PhpStorm.
 * User: wsferreira
 * Date: 27/07/19
 * Time: 18:10
 */

namespace App\Service;

use App\Entity\Media;
use App\Entity\MediaType;
use App\Repository\MediaRepository;
use App\ValueObject\MediaPaginatorVO;
use App\ValueObject\MediaVO;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Exception;

class MediaService
{
    const ASC = 'asc';
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * MediaService constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param MediaVO $mediaVO
     * @return Media
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws Exception
     */
    public function createMedia(MediaVO $mediaVO): ?Media {
        /** @var MediaType $mediaTypeObject */
        $mediaTypeObject = $this->entityManager->getRepository(MediaType::class)->find($mediaVO->type);

        if(empty($mediaTypeObject)){
            throw new Exception('Tipo de media não foi encontrado', 400);
        }

        $mediaObject = new Media();
        $mediaObject->setTitle($mediaVO->title);
        $mediaObject->setDescription($mediaVO->description);
        $mediaObject->setType($mediaTypeObject);

        $this->entityManager->persist($mediaObject);
        $this->entityManager->flush();

        return $mediaObject;
    }

    /**
     * @param MediaVO $mediaVO
     * @return Media
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws Exception
     */
    public function updateMedia(MediaVO $mediaVO): Media
    {
        /** @var Media $mediaObject */
        $mediaObject = $this->entityManager->getRepository(Media::class)->find($mediaVO->id);

        if(empty($mediaObject)){
            throw new Exception('Media não encontrada', 400);
        }

        /** @var MediaType $mediaTypeObject */
        $mediaTypeObject = $this->entityManager->getRepository(MediaType::class)->find($mediaVO->type);
        if(empty($mediaTypeObject)){
            throw new Exception('Tipo de media não foi encontrada na hora de atualizar', 400);
        }

        $mediaObject->setDescription($mediaVO->description);
        $mediaObject->setTitle($mediaVO->title);
        $mediaObject->setType($mediaTypeObject);

        $this->entityManager->persist($mediaObject);
        $this->entityManager->flush();

        return $mediaObject;
    }

    /**
     * @param int $id
     * @return Media
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws Exception
     */
    public function deleteMedia(int $id): Media
    {
        /** @var Media $mediaObject */
        $mediaObject = $this->entityManager->getRepository(Media::class)->find($id);

        if(empty($mediaObject)) {
            throw new Exception('media não encontrada', 400);
        }

        $this->entityManager->remove($mediaObject);
        $this->entityManager->flush();

        return $mediaObject;
    }

    /**
     * @return Media[]|array
     */
    public function findAllMedia(): array
    {
        return $this->entityManager->getRepository(Media::class)->findAll();
    }

    public function findMedia(int $id): ?Media
    {
        /** @var Media|null $mediaObject */
        $mediaObject = $this->entityManager->getRepository(Media::class)->find($id);
        return $mediaObject;
    }

    /**
     * @param int $firstResult
     * @param int $maxResults
     * @param string $columnOrder
     * @param string $order
     * @return MediaPaginatorVO
     * @throws Exception
     */
    public function findBy(int $firstResult = 0, int $maxResults = 10, string $columnOrder = 'id', $order = self::ASC)
    {
        /** @var MediaRepository $mediaObject */
        $mediaObject = $this->entityManager->getRepository(Media::class);
        return $mediaObject->findAllMediaWithPagination($firstResult, $maxResults, $columnOrder, $order);
    }
}
