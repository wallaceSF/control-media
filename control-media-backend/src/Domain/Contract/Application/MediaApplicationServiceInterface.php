<?php

namespace App\Domain\Contract\Application;

interface MediaApplicationServiceInterface
{
public function findAllMedia();
    public function findMedia(int $id);
}
