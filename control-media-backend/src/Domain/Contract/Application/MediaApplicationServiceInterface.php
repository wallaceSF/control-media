<?php

namespace App\Domain\Contract\Application;

use App\Domain\Entity\Media;

interface MediaApplicationServiceInterface
{
    public function findAllMedia(): array;
    public function findMedia(int $id): ?Media;
    public function createMedia($r): ?Media;
}
