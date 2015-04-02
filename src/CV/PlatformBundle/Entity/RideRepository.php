<?php

namespace CV\PlatformBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;


class RideRepository extends EntityRepository {
   	public function requestRidesFiltered($departure, $arrival) {
		$listRides = $this->findBy(
  			array('departure' => $departure,
				'arrival' => $arrival,
  			),
  			null,
  			null,
  			null,
  			null
		);
	    return $listRides;
   	}

   	public function requestOngoingRidesUser($page, $nbPerPage, $idUser) {
        $query = $this->createQueryBuilder('r')
            ->leftJoin('r.user', 'user')
            ->addSelect('user')
            ->where('r.user = :user')
                ->setParameter('user', $idUser)
            ->orderBy('r.offerPublished', 'DESC')
            ->getQuery();

        $query
            ->setFirstResult(($page-1) * $nbPerPage)
            ->setMaxResults($nbPerPage);

        return new Paginator($query, true);
   	}

    public function focusRidesUser($departure, $arrival, $departure_date, $page, $nbPerPage) {
        $query = $this->createQueryBuilder('r')
            ->where('r.departure = :departure')
                ->setParameter('departure', $departure)
            ->andWhere('r.arrival = :arrival')
                ->setParameter('arrival', $arrival)
            ->andWhere('r.departureDate LIKE :departureDate')
                ->setParameter('departureDate', $departure_date.'%')
            ->orderBy('r.offerPublished', 'DESC')
            ->getQuery();

        $query
            ->setFirstResult(($page-1) * $nbPerPage)
            ->setMaxResults($nbPerPage);

        return new Paginator($query, true);
    }
}
