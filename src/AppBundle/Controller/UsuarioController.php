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
    public function registroAction(Request $request) {
        $usuario = new Usuario();

        $usuario->setPermiteEmail(true);

        $formulario = $this->createForm('AppBundle\Form\UsuarioType', $usuario);
        $formulario->add('registrame','submit');
        
        $formulario->handleRequest($request);

        if ($formulario->isValid()) {

            //encriptamos la contraseÃ±a
            $encoder = $this->get('security.encoder_factory')->getEncoder($usuario);
            $passwordCodificado = $encoder->encodePassword(
                                             $usuario->getPassword(), null);
            $usuario->setPassword($passwordCodificado);
            //guardamos en la base de datos
            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario);
            $em->flush();

            //Despues de guardar nos logamos
            $token = new UsernamePasswordToken(
                                $usuario,
                                $usuario->getPassword(), 'frontend',
                                $usuario->getRoles()
                                );
            $this->container->get('security.token_storage')->setToken($token);

            //aÃ±adimos un mensaje de retorno
            $this->addFlash('info', 'Â¡Enhorabuena! Te has registrado correctamente en Cupon');

            //nos redirigimos a la portada
            return $this->redirectToRoute('portada', array(
                        'ciudad' => $usuario->getCiudad()->getSlug()));
        }


        return $this->render('usuario/registro.html.twig', array(
                    'formulario' => $formulario->createView()
        ));
    }

    
    /**
     * @Route("/perfil", name="usuario_perfil")
     */
    public function perfilAction(Request $request) {
        
        $usuario = $this->getUser();
        
        $formulario = $this->createForm('AppBundle\Form\UsuarioType', $usuario);
        $formulario->add('guardar','submit',array('label'=>'Guardar Cambios'));

        $formulario->handleRequest($request);

        if ($formulario->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario);
            $em->flush();

            $this->addFlash('info', 'Los datos de tu perfil se han actualizado correctamente');
            return $this->redirectToRoute('usuario_perfil');
        }
        
        return $this->render('usuario/registro.html.twig', array(
                    'formulario' => $formulario->createView()
        ));
        
    }
    
    
    
}
