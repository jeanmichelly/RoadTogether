<?php

namespace CV\PlatformBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * RatingRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RatingRepository extends EntityRepository
{
    public function updateToNotify($userId) {
        // En tant que passager
        $query = $this->_em->createQuery('
            SELECT r, ride 
            FROM CVPlatformBundle:Reservation r
            JOIN r.ride ride
            WHERE r.user = :user
            AND r.state = 0
            AND ride.departureDate < :now
            AND NOT EXISTS (
                SELECT ra
                FROM CVPlatformBundle:Rating ra
                WHERE ra.user = :user
                AND ra.relateduser = ride.user
                )
        GROUP BY ride.user')
        ->setParameter('user', $userId)
        ->setParameter('now', date('Y-m-d H:i:s'));

        foreach ($query->getResult() as $reservation) {
            $rating = new Rating();
            $rating->setUser($reservation->getUser());
            $rating->setRelateduser($reservation->getRide()->getUser());
            $rating->setState(0);
            $this->_em->persist($rating);
            $this->_em->flush();
        }

        // En tant que conducteur
        $query = $this->_em->createQuery('
            SELECT r, reservation 
            FROM CVPlatformBundle:Ride r
            JOIN r.reservations reservation
            WHERE r.user = :user
            AND r.state = 0
            AND r.departureDate < :now
            AND NOT EXISTS (
                SELECT ra
                FROM CVPlatformBundle:Rating ra
                WHERE ra.user = :user
                AND ra.relateduser = reservation.user
                )
        GROUP BY r.user')
        ->setParameter('user', $userId)
        ->setParameter('now', date('Y-m-d H:i:s'));

        foreach ($query->getResult() as $ride) {
            foreach ($ride->getReservations() as $reservation) {
                $rating = new Rating();
                $rating->setUser($ride->getUser());
                $rating->setRelateduser($reservation->getUser());
                $rating->setState(0);
                $this->_em->persist($rating);
                $this->_em->flush();
            }
        }
    }

    public function myNotifications($userId) {
        $query = $this->createQueryBuilder('r')
        ->leftJoin('r.user', 'user')
        ->addSelect('user')
        ->where('r.user = :user')
        ->setParameter('user', $userId)
        ->andWhere('r.state = 0')
        ->getQuery();

        return $query->getResult();
    }

    public function numberOfNotification($userId) {
        $query = $this->_em->createQuery('
            SELECT COUNT(r.id) 
            FROM CVPlatformBundle:Rating r
            WHERE r.user = :user
            AND r.state = 0')
        ->setParameter('user', $userId);
        return $query->getSingleScalarResult();
    }

    public function ratingsReceived($userId) {
        $query = $this->createQueryBuilder('r')
        ->where('r.relateduser = :user')
        ->andWhere('r.state = 1')
        ->setParameter('user', $userId)
        ->orderBy('r.date', 'DESC')
        ->getQuery();

        return $query->getResult();
    }

    public function ratingsReceivedWithoutPaginator($userId) {
        $query = $this->createQueryBuilder('r')
        ->where('r.relateduser = :user')
        ->andWhere('r.state = 1')
        ->setParameter('user', $userId)
        ->orderBy('r.date', 'DESC')
        ->getQuery();

        return $query->getResult();
    }   	

    public function ratingsSended($userId) {
        $query = $this->createQueryBuilder('r')
        ->where('r.user = :user')
        ->andWhere('r.state = 1')
        ->setParameter('user', $userId)
        ->orderBy('r.date', 'DESC')
        ->getQuery();

        return $query->getResult();
    }	

    public function totalEvaluation($userId) {
        $query = $this->_em->createQuery('
            SELECT COUNT(r) 
            FROM CVPlatformBundle:Rating r
            WHERE r.relateduser = :userId')
        ->setParameter('userId', $userId);

        return $query->getSingleScalarResult();
    }   

    public function countEvaluation($userId, $evaluation) {
        $query = $this->_em->createQuery('
            SELECT COUNT(r) 
            FROM CVPlatformBundle:Rating r
            WHERE r.relateduser = :userId
            AND r.evaluation = :evaluation')
        ->setParameter('userId', $userId)
        ->setParameter('evaluation', $evaluation);

        return $query->getSingleScalarResult();
    }

    public function totalRatings() {
        $query = $this->_em->createQuery('
            SELECT COUNT(r) 
            FROM CVPlatformBundle:Rating r');
        
        return $query->getSingleScalarResult();
    }

    public function avgEvaluations($userId) {
        $query = $this->_em->createQuery('
            SELECT avg(r.evaluation) 
            FROM CVPlatformBundle:Rating r
            WHERE r.relateduser = :userId
            GROUP BY r.relateduser')
        ->setParameter('userId', $userId);
        
        return $query->getSingleScalarResult();
    }     

    public function avgDriving($userId) {
        $query = $this->_em->createQuery('
            SELECT avg(r.driving) 
            FROM CVPlatformBundle:Rating r
            WHERE r.relateduser = :userId
            GROUP BY r.relateduser')
        ->setParameter('userId', $userId);
        
        return $query->getSingleScalarResult();
    }     
}
