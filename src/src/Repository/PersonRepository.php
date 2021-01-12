<?php

namespace App\Repository;


use App\Entity\Person;
use App\Services\PersonStateConstants;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use http\Env\Request;

/**
 * @method Person|null find($id, $lockMode = null, $lockVersion = null)
 * @method Person|null findOneBy(array $criteria, array $orderBy = null)
 * @method Person[]    findAll()
 * @method Person[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonRepository extends ServiceEntityRepository
{
    private $manager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        parent::__construct($registry, Person::class);
        $this->manager = $manager;
    }

    public function save($request)
    {
        $newPerson = new Person();

        $newPerson
            ->setLogin($request['login'])
            ->setFName($request['fname'])
            ->setLName($request['lname'])
            ->setState(PersonStateConstants::STATE_ACTIVE);

        $this->manager->persist($newPerson);
        $this->manager->flush();
    }
    // /**
    //  * @return Person[] Returns an array of Person objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Person
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /**
     * @param int|null $id
     * @return false|int|mixed|string
     */
    public function getPerson(?int $id)
    {
        if (is_int($id)) {
            return $this->find($id);
        }

        return false;
    }

    public function store(array $data)
    {
        $person = $this->find($data['id']);
        empty($data['fname']) ? true : $person->setFName($data['fname']);
        empty($data['lname']) ? true : $person->setLName($data['lname']);
        empty($data['login']) ? true : $person->setLogin($data['login']);
        empty($data['state']) ? true : $person->setState($data['state']);

        $this->manager->flush();
    }

    public function removeCustomer(Customer $customer)
    {
        $this->manager->remove($customer);
        $this->manager->flush();
    }

    public function filter(array $data)
    {
        $qb = $this->createQueryBuilder('per');

        if (isset($data['lname']) && !empty($data['lname'])) {
            $lname = $data['lname'];
            $qb->andWhere('per.lName like :lname')
                ->setParameter('lname', '%'.$lname.'%');
        }
        if (isset($data['fname']) && !empty($data['fname'])) {
            $fname = $data['fname'];
            $qb->andWhere('per.fName like :fname')
                ->setParameter('fname', '%'.$fname.'%');
        }
        if (isset($data['login']) && !empty($data['login'])) {
            $login = $data['login'];
            $qb->andWhere('per.login like :login')
                ->setParameter('login', '%'.$login).'%';
        }
        if (isset($data['state']) && !empty($data['state'])) {
            $state = $data['state'];
            $qb->andWhere('per.state = :state')
                ->setParameter('state', $state);
        }

        $qb->orderBy('per.id', 'desc');
        $query = $qb->getQuery();

        return $query->execute();
    }
}
