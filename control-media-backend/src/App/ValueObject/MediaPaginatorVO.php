<?php

namespace App\ValueObject;

class MediaPaginatorVO
{
    /**
     * @var MediaVO[]
     */
    public $mediaVO;
    /**
     * @var int
     */
    public $total;
    /**
     * @var int
     */
    public $currentFirst;
    /**
     * @var int
     */
    public $currentMax;

    /**
     * @var array
     */
    public $columnOrder = ['media-title' => 'media.title', 'media-description' => 'media.description', 'type-description'=>'type.description'];
}
