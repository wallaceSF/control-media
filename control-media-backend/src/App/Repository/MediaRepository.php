<?php

namespace App\Repository;

class MediaRepository extends \Doctrine\ORM\EntityRepository
{
    public function findMediaBy(array $params = [], int $firstResult = 0, int $maxResults = 10, $order = 'asc'){
        $dql = "SELECT m FROM Media m ORDER BY m.id ASC";
        $query = $this->getEntityManager()->createQuery($dql)
            ->setFirstResult($firstResult)
            ->setMaxResults($maxResults);

        var_dump($query); die('repository');

     //   $paginator = new Paginator($query, $fetchJoinCollection = true);

     //   $c = count($paginator);
      //  foreach ($paginator as $post) {
      //      echo $post->getHeadline() . "\n";
        //}
    }

}