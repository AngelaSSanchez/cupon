<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class UsuarioRepository extends EntityRepository
{
    

    /**
     * Encuentra las cinco ciudades más cercanas a la ciudad indicada.
     *
     * @param int $ciudadId El id de la ciudad para la que se buscan cercanas
     *
     * @return array
     */
    public function findTodasLasCompras($usuarioId)
    {
        $em = $this->getEntityManager();

        $consulta = $em->createQuery('
            SELECT v, o, t
            FROM AppBundle:Venta v
            JOIN v.oferta o
            JOIN o.tienda t
            WHERE v.usuario = :id
            ORDER BY v.fecha DESC
        ');
        $consulta->setParameter('id', $usuarioId);
        return $consulta->getResult();
    }


}
