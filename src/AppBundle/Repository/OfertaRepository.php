<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Oferta;
use Doctrine\ORM\EntityRepository;

class OfertaRepository extends EntityRepository
{

    public function findOfertaDelDia($ciudad)
    {
        $em = $this->getEntityManager();
        $fecha = new \DateTime('today');
        $fecha->setTime(23, 59, 59);
       
        $sql = 'SELECT o, c, t 
                FROM AppBundle:Oferta o
                JOIN o.ciudad c
                JOIN o.tienda t
                WHERE o.revisada = true
                AND c.slug = :ciudad 
                AND o.fechaPublicacion < :fecha
                ORDER BY o.fechaPublicacion DESC';
 
        $consulta = $em->createQuery($sql);
        $consulta->setParameter('ciudad', $ciudad);
        $consulta->setParameter('fecha', $fecha);
        $consulta->setMaxResults(1);
        
        $oferta = $consulta->getSingleResult();

        return $oferta;
    }

    public function findOferta($ciudad, $slug)
    {
        $em = $this->getEntityManager();

        $sql = 'SELECT o, c, t 
                FROM AppBundle:Oferta o
                JOIN o.ciudad c
                JOIN o.tienda t
                WHERE o.revisada = true
                AND c.slug = :ciudad 
                AND o.slug = :slug ';
 
        $consulta = $em->createQuery($sql);
        $consulta->setParameter('slug', $slug);
        $consulta->setParameter('ciudad', $ciudad);
        $consulta->setMaxResults(1);
        
        $oferta = $consulta->getSingleResult();

        return $oferta;
    }
    
        public function findRelacionadas($ciudad, $slug)
    {
        $em = $this->getEntityManager();

        $sql = 'SELECT o, c, t 
                FROM AppBundle:Oferta o
                JOIN o.ciudad c
                JOIN o.tienda t
                WHERE o.revisada = true
                AND c.slug = :ciudad
                AND o.slug != :slug';
 
        $consulta = $em->createQuery($sql);
        $consulta->setParameter('slug', $slug);
        $consulta->setParameter('ciudad', $ciudad);
        $consulta->setMaxResults(5);
        
        $ofertas = $consulta->getResult();

        return $ofertas;
    }
    
    /**
     * Encuentra las cinco ofertas más recuentes de la ciudad indicada.
     *
     * @param int $ciudad_id El id de la ciudad
     *
     * @return array
     */
    public function findRecientes($ciudadId)
    {
        $em = $this->getEntityManager();

        $consulta = $em->createQuery('
            SELECT o, t
            FROM AppBundle:Oferta o JOIN o.tienda t
            WHERE o.revisada = true AND o.fechaPublicacion < :fecha AND o.ciudad = :id
            ORDER BY o.fechaPublicacion DESC
        ');
        $consulta->setMaxResults(5);
        $consulta->setParameter('id', $ciudadId);
        $consulta->setParameter('fecha', new \DateTime('today'));
        $consulta->useResultCache(true, 600);

        return $consulta->getResult();
    }
   
}
