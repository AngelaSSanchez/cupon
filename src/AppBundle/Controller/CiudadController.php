<?php


namespace AppBundle\Controller;

use AppBundle\Entity\Ciudad;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CiudadController extends Controller
{
    
    /**
     * @Route("/ciudad/cambiar-a-{ciudad}", 
     * requirements={ "ciudad" = ".+" }, 
     * name="ciudad_cambiar")
     * 
     */
    
    public function cambiarAction($ciudad){
        
        return $this->redirectToRoute('portada',  array('ciudad' => $ciudad));
        
    }
  
    public function listaCiudadesAction($ciudad){
        
         $em = $this->getDoctrine()->getManager();
         $ciudades = $em->getRepository('AppBundle:Ciudad')->findAll();
         
         
        return $this->render('ciudad/_lista_ciudades.html.twig', 
                array( 'ciudadActual' => $ciudad,
                    'ciudades' => $ciudades
                ));
    }
    
    
    
    /**
     * @Route("/{ciudad}/recientes", name="ciudad_recientes")
     *
     * Muestra las ofertas más recientes de la ciudad indicada.
     *
     * @param Request $request
     * @param string  $ciudad  El slug de la ciudad
     *
     * @return Response
     *
     * @throws NotFoundHttpException
     */
    public function recientesAction(Request $request, $ciudad)
    {
        $em = $this->getDoctrine()->getManager();

        $ciudad = $em->getRepository('AppBundle:Ciudad')->findOneBySlug($ciudad);
        
        $cercanas = $em->getRepository('AppBundle:Ciudad')->findCercanas($ciudad->getId());
        
        $ofertas = $em->getRepository('AppBundle:Oferta')->findRecientes($ciudad->getId());

        $formato = $request->getRequestFormat();
        
        return $this->render('ciudad/recientes.'.$formato.'.twig', array(
            'ciudad' => $ciudad,
            'cercanas' => $cercanas,
            'ofertas' => $ofertas
        ));
    }
    
    
}
