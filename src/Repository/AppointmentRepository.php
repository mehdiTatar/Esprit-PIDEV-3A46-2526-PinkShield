<?php

namespace App\Repository;

use App\Entity\Appointment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Appointment>
 */
class AppointmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Appointment::class);
    }

    /**
     * @return Appointment[] Returns an array of Appointment objects for a patient
     */
    public function findByPatient(string $email): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.patientEmail = :email')
            ->setParameter('email', $email)
            ->orderBy('a.appointmentDate', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Appointment[] Returns an array of Appointment objects for a doctor
     */
    public function findByDoctor(string $email): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.doctorEmail = :email')
            ->setParameter('email', $email)
            ->orderBy('a.appointmentDate', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
