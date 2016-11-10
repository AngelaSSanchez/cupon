<?php

namespace AppBundle\Controller;

//use AppBundle\Entity\Tienda;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExtranetController extends Controller
{
    
    /**
     * @Route("/",  name="extranet_portada")
     */
    public function portadaAction(){
        
         return $this->render('extranet.html.twig');
    }

    /**
     * @Route("/oferta/nueva",  name="extranet_oferta_nueva")
     */
    public function ofertaNuevaAction(){
    
        return true;
    }    

    /**
     * @Route("/oferta/editar",  name="extranet_oferta_editar")
     */
    public function ofertaEditarAction(){
    return true;
    }

    /**
     * @Route("/oferta/ventas",  name="extranet_oferta_ventas")
     */
    public function ofertaVentasAction(){
    return true;
    }
    
    /**
     * @Route("/perfil",  name="extranet_perfil")
     */
    public function perfilAction(){         
        return true;
    }    

    /**
     * @Route("/login", name="extranet_login")
     */    
    public function loginAction(){
        $authUtils = $this->get('security.authentication_utils');
        return $this->render('extranet/login.html.twig', array(
                              'last_username'=>$authUtils->getLastUsername(),
                              'error'=>$authUtils->getLastAuthenticationError()
                        ));    
    }
    
    /**
     * @Route("/login_check", name="extranet_login_check")
     */    
    public function loginCheckAction(){
        $usuario = $this->get('security.token_storage')->getToken()->getUser();
        return $this->render('extranet/_caja_login.html.twig', array(
                              'usuario'=>$usuario
                        ));    
    }
    
    /**
     * @Route("/logout", name="extranet_logout")
     */    
    public function logoutAction(){
        
    }    
    
    
    
}
