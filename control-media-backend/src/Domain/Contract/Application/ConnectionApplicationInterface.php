<?php


namespace App\Domain\Contract\Application;


interface ConnectionApplicationInterface
{
    public function beginTransaction();

    public function commit();

    public function rollback();

}