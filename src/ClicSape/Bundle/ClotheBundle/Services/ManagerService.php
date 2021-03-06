<?php

namespace ClicSape\Bundle\ClotheBundle\Services;

use Doctrine\ORM\EntityRepository;
/**
 * Description of ManagerService
 *
 * @author johan
 */
class ManagerService {
    
    protected $repository ;
    
    public function __construct(EntityRepository $repository) {
        $this->repository = $repository;
    }
    
    public function getRepository(){
        return $this->repository;
    }
    
    public function findAll(){
        return $this->repository->findAll();
    }

    public function findByFilter($filters){
        $queryBuilder = null;
        foreach($filters as $filter => $value){
            $queryBuilder = $this->repository->findByFilter($queryBuilder,$filter,$value);
        }
        $result = $queryBuilder->getQuery()->getResult();
        if(empty($result)){
            return $this->repository->findAll();
        }
        return $result;
    }
    
    public function findByFilterJoin($entityJoin,$data){        
        $queryBuilder = $this->repository->findByFilterJoin($entityJoin,$data);
        $result = $queryBuilder->getQuery()->getResult();
        
        return $result;
    }

}
