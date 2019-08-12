<?php
/**
 * Created by PhpStorm.
 * User: wsferreira
 * Date: 27/07/19
 * Time: 18:10
 */

namespace App\Domain\Service;

use App\Domain\Contract\Infrastruture\Repository\MediaRepositoryInterface;
use App\Domain\Contract\Infrastruture\Repository\MediaTypeRepositoryInterface;
use App\Domain\Entity\Media;
use App\Domain\Entity\MediaType;
use App\Domain\ValueObject\MediaPaginatorVO;
use App\Domain\ValueObject\MediaVO;
use Exception;

class MediaService
{
    const ASC = 'asc';
    /**
     * @var MediaRepositoryInterface
     */
    private $mediaRepository;
    /**
     * @var MediaTypeRepositoryInterface
     */
    private $mediaTypeRepository;
    /**
     * @var MediaPersonLoanService
     */
    private $mediaPersonLoanService;

    /**
     * MediaService constructor.
     * @param MediaRepositoryInterface $mediaRepository
     * @param MediaTypeRepositoryInterface $mediaTypeRepository
     * @param MediaPersonLoanService $mediaPersonLoanService
     */
    public function __construct(
        MediaRepositoryInterface $mediaRepository,
        MediaTypeRepositoryInterface $mediaTypeRepository,
        MediaPersonLoanService $mediaPersonLoanService
    ) {
        $this->mediaRepository = $mediaRepository;
        $this->mediaTypeRepository = $mediaTypeRepository;
        $this->mediaPersonLoanService = $mediaPersonLoanService;
    }

    /**
     * @param MediaVO $mediaVO
     * @return Media|null
     * @throws Exception
     */
    public function createMedia(MediaVO $mediaVO): ?Media {
        /** @var MediaType $mediaTypeObject */
        $mediaTypeObject = $this->mediaTypeRepository->find($mediaVO->type);

        if(empty($mediaTypeObject)){
            throw new Exception('Tipo de media não foi encontrado', 400);
        }

        $mediaObject = new Media();
        $mediaObject->setTitle($mediaVO->title);
        $mediaObject->setDescription($mediaVO->description);
        $mediaObject->setType($mediaTypeObject);

        $this->mediaRepository->persist($mediaObject);

        return $mediaObject;
    }

    /**
     * @param MediaVO $mediaVO
     * @return Media
     * @throws Exception
     */
    public function updateMedia(MediaVO $mediaVO): Media
    {
        /** @var Media $mediaObject */
        $mediaObject = $this->mediaRepository->find($mediaVO->id);

        if(empty($mediaObject)) {
            throw new Exception('Media não encontrada', 400);
        }

        /** @var MediaType $mediaTypeObject */
        $mediaTypeObject = $this->mediaTypeRepository->find($mediaVO->type);
        if(empty($mediaTypeObject)){
            throw new Exception('Tipo de media não foi encontrada na hora de atualizar', 400);
        }

        $mediaObject->setDescription($mediaVO->description);
        $mediaObject->setTitle($mediaVO->title);
        $mediaObject->setType($mediaTypeObject);

        $this->mediaRepository->persist($mediaObject);

        return $mediaObject;
    }

    /**
     * @param int $id
     * @return Media
     * @throws Exception
     */
    public function deleteMedia(int $id): Media
    {
        /** @var Media $mediaObject */
        $mediaObject = $this->mediaRepository->find($id);
        if(empty($mediaObject)) {
            throw new Exception('mídia não encontrada', 400);
        }



        $InfoLoanVO = $this->mediaPersonLoanService->returnDataPersonPickedUpBookHandler($mediaObject->getId());

        if(!is_null($InfoLoanVO) && $InfoLoanVO->borrowed){
            throw new \Exception('Essa mídia está em emprestimo, não pode ser deletada', 403);
        }

        $listMediaPersonLoan = $this->mediaPersonLoanService->findAllMediaPersonLoanByMedia($mediaObject->getId());

        if(!empty($listMediaPersonLoan)) {
            throw new \Exception('Essa mídia existe um vínculo, um histórico de emprestimo e não pode ser deletada', 403);
        }

        $this->mediaRepository->remove($mediaObject);
        return $mediaObject;
    }

    /**
     * @return Media[]|array
     */
    public function findAllMedia(): array
    {
        return $this->mediaRepository->findAll();
    }

    public function findMedia(int $id): ?Media
    {
        /** @var Media|null $mediaObject */
        $mediaObject = $this->mediaRepository->find($id);
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
        return $this->mediaRepository->findAllMediaWithPagination($firstResult, $maxResults, $columnOrder, $order);
    }
}
