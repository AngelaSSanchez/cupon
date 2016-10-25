<?php


namespace AppBundle\Controller;

use AppBundle\Entity\Ciudad;
use AppBundle\Entity\Usuario;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("/usuario")
 */
class UsuarioController extends Controller
{
    
    /**
     * @Route("/compras", name="usuario_compras")
     * 
     */
    public function comprasAction(){
  
        $em = $this->getDoctrine()->getManager();
        $usuario = $this->get('security.token_storage')->getToken()->getUser();
        //$usuarioId=1;
        $compras = $em->getRepository('AppBundle:Usuario')
                ->findTodasLasCompras($usuario->getId());
         
        return $this->render('usuario/compras.html.twig',array( 
            'compras' => $compras  ));
        
        
    }
        
    /**
     * @Route("/login", name="usuario_login")
     */    
    public function loginAction(){
        $authUtils = $this->get('security.authentication_utils');
        return $this->render('usuario/login.html.twig', array(
                              'last_username'=>$authUtils->getLastUsername(),
                              'error'=>$authUtils->getLastAuthenticationError()
                        ));    
    }
    
    /**
     * @Route("/login_check", name="usuario_login_check")
     */    
    public function loginCheckAction(){
        $usuario = $this->get('security.token_storage')->getToken()->getUser();
        return $this->render('usuario/_caja_login.html.twig', array(
                              'usuario'=>$usuario
                        ));    
    }
    
    /**
     * @Route("/logout", name="usuario_logout")
     */    
    public function logoutAction(){
        
    }
    
    /**
    * @Route("/registro", name="usuario_registro")
    */
    public function registroAction(Request $request)
    {
        $usuario = new Usuario();
        $usuario->setPermiteEmail(true);
        $usuario->setNombre("escribe tu nombre aquí");
        $formulario = $this->createForm('AppBundle\Form\UsuarioType',$usuario);
        $formulario->handleRequest($request);
        if ($formulario->isValid()){
            echo(" es valido");
        } 
        return $this->render('usuario/registro.html.twig', array(
                              'usuario'=>$usuario,
                              'formulario'=>$formulario->createView()
                        ));
    }
}
