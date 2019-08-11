<?php
/**
 * Created by PhpStorm.
 * User: wsferreira
 * Date: 27/07/19
 * Time: 18:10
 */

namespace App\Domain\Service;

use App\Domain\Contract\Infrastruture\Repository\MediaPersonLoanRepositoryInterface;
use App\Domain\Contract\Infrastruture\Repository\MediaRepositoryInterface;
use App\Domain\Contract\Infrastruture\Repository\PersonRepositoryInterface;
use App\Domain\Entity\Media;
use App\Domain\Entity\MediaPersonLoan;
use App\Domain\Entity\Person;
use App\Domain\ValueObject\InfoLoanVO;
use App\Domain\ValueObject\MediaPersonLoanVO;
use Exception;

class MediaPersonLoanService
{
    /**
     * @var MediaPersonLoanRepositoryInterface
     */
    private $mediaPersonLoanRepository;
    /**
     * @var MediaRepositoryInterface
     */
    private $mediaRepository;
    /**
     * @var PersonRepositoryInterface
     */
    private $personRepository;

    /**
     * MediaPersonLoanService constructor.
     * @param MediaPersonLoanRepositoryInterface $mediaPersonLoanRepository
     * @param MediaRepositoryInterface $mediaRepository
     * @param PersonRepositoryInterface $personRepository
     */
    public function __construct(
        MediaPersonLoanRepositoryInterface $mediaPersonLoanRepository,
        MediaRepositoryInterface $mediaRepository,
        PersonRepositoryInterface $personRepository
    ) {
        $this->mediaPersonLoanRepository = $mediaPersonLoanRepository;
        $this->mediaRepository = $mediaRepository;
        $this->personRepository = $personRepository;
    }

    /**
     * @return MediaPersonLoan[]|array
     */
    public function findAllMediaPersonLoan(): array
    {
        return $this->mediaPersonLoanRepository->findAll();
    }

    public function returnDataPersonPickedUpBookHandler(int $mediaId): ?InfoLoanVO
    {
        /** @var MediaPersonLoan $check */
        $mediaPersonLoan = $this->mediaPersonLoanRepository->getLastestMediaData($mediaId);

        if(is_null($mediaPersonLoan)){
            return null;
        }

        $returnedAt = $mediaPersonLoan->getReturnedAt();
        if(!empty($mediaPersonLoan) && !is_null($returnedAt)){
            return null;
        }

        $inforLoanVO = new InfoLoanVO();
        $inforLoanVO->person = $mediaPersonLoan->getPerson();
        $inforLoanVO->borrowed = true;

        return $inforLoanVO;
    }

    /**
     * @param MediaPersonLoanVO $mediaPersonLoan
     * @return MediaPersonLoan
     * @throws Exception
     */
    public function createMediaPersonLoan(MediaPersonLoanVO $mediaPersonLoan)
    {
        /** @var Media $mediaObject */
        $mediaObject = $this->mediaRepository->find($mediaPersonLoan->media);

        /** @var Person $personObject */
        $personObject = $this->personRepository->find($mediaPersonLoan->person);

        if(empty($mediaObject)){
            throw new Exception('Mídia não foi encontrado', 400);
        }

        if(empty($personObject)){
            throw new Exception('Pessoa não foi encontrada', 400);
        }

        $mediaPersonLoanObject = new MediaPersonLoan();
        $mediaPersonLoanObject->setMedia($mediaObject);
        $mediaPersonLoanObject->setPerson($personObject);

        $this->mediaPersonLoanRepository->persist($mediaPersonLoanObject);

        return $mediaPersonLoanObject;
    }

    public function returnMediaPersonLoan(MediaPersonLoanVO $mediaPersonLoanVO): MediaPersonLoan
    {
        /** @var MediaPersonLoan $mediaPersonLoan */
        $mediaPersonLoan = $this->mediaPersonLoanRepository->findByPersonAndMedia($mediaPersonLoanVO);
        $mediaPersonLoan->setReturnedAt(new \DateTime());

        return $this->mediaPersonLoanRepository->persist($mediaPersonLoan);
    }
}
