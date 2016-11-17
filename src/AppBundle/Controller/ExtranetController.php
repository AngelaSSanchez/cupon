<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Oferta;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExtranetController extends Controller
{
    
/**
     * @Route("/login", name="extranet_login")
     * Muestra el formulario de login
     * @return Response
     */
    public function loginAction()
    {
        $authUtils = $this->get('security.authentication_utils');

        return $this->render('extranet/login.html.twig', array(
            'last_username' => $authUtils->getLastUsername(),
            'error' => $authUtils->getLastAuthenticationError(),
        ));
    }

    /**
     * @Route("/login_check", name="extranet_login_check")
     */
    public function loginCheckAction()
    {
        // el "login check" lo hace Symfony automáticamente, pero es necesario
        // definir una ruta /login_check. Por eso existe este método vacío.
    }

    /**
     * @Route("/logout", name="extranet_logout")
     */
    public function logoutAction()
    {
            // Set the token to null and invalidate the session
            $this->getSecurityContext()->setToken(null);
            $this->getSession()->invalidate();

            // Redirect url and seconds (window.location)
            $seconds  = 5;
            $redirect = $this->getRouter()->generate('extranet_login');

            return array('seconds' => $seconds, 'redirect' => $redirect);
    }
    
    
    
    
    /**
     * @Route("/",  name="extranet_portada")
     */
    public function portadaAction(){
    
        $tienda = $this->getUser();
        
        $em = $this->getDoctrine()->getManager();
        
        $ofertas = $em->getRepository('AppBundle:Tienda')
                ->findOfertasRecientes($tienda->getId());

        return $this->render('extranet/portada.html.twig', array(
            'ofertas' => $ofertas,
        ));

    }

    /**
     * @Route("/oferta/nueva",  name="extranet_oferta_nueva")
     */
    public function ofertaNuevaAction(Request $request)
    {
         $tienda = $this->get('security.token_storage')->getToken()->getUser();

        $oferta = new Oferta();
        
        $formulario = $this->createForm('AppBundle\Form\OfertaType', $oferta);
        $formulario->handleRequest($request);

        if ($formulario->isValid()) {

            $oferta->setCompras(0);
            $oferta->setTienda($tienda);
            $oferta->setCiudad($tienda->getCiudad());
            
            $ruta = $this->container->getParameter('app.directorio.imagenes');
            $oferta->subirFoto($ruta);

            $em = $this->getDoctrine()->getManager();
            $em->persist($oferta);
            $em->flush();
            
//          $this->get('app.manager.oferta_manager')->guardar($oferta);

            return $this->redirectToRoute('extranet_portada');
        }

        return $this->render(
            'extranet/oferta.html.twig', array(
            'accion' => 'crear',
            'formulario' => $formulario->createView(),
        ));
   
    }    

    /**
     * @Route("/oferta/editar/{id}",  name="extranet_oferta_editar")
     */
    public function ofertaEditarAction(Request $request, Oferta $oferta){
    
        $formulario = $this->createForm('AppBundle\Form\OfertaType', $oferta);
        $formulario->handleRequest($request);

        if ($formulario->isValid()) {

            $ruta = $this->container->getParameter('app.directorio.imagenes');
            $oferta->subirFoto($ruta);

            $em = $this->getDoctrine()->getManager();
            $em->persist($oferta);
            $em->flush();
            
//          $this->get('app.manager.oferta_manager')->guardar($oferta);

            return $this->redirectToRoute('extranet_portada');
            
            
        }
        
        return $this->render(
            'extranet/oferta.html.twig', array(
            'accion' => 'editar',
            'oferta' => $oferta,
            'formulario' => $formulario->createView(),
        ));
    }

    /**
     * @Route("/oferta/ventas/{id}", name="extranet_oferta_ventas")
     *
     * Muestra las ventas registradas para la oferta indicada.
     *
     * @param Oferta $oferta
     *
     * @return Response
     */
    public function ofertaVentasAction(Oferta $oferta)
    {
        $em = $this->getDoctrine()->getManager();
        $ventas = $em->getRepository('AppBundle:Oferta')->findVentasByOferta($oferta->getId());

        return $this->render('extranet/ventas.html.twig', array(
            'oferta' => $oferta,
            'ventas' => $ventas,
        ));
    }
    
    /**
     * @Route("/perfil",  name="extranet_perfil")
     */
    public function perfilAction(Request $request)
    {
        $tienda = $this->getUser();
        
        $formulario = $this->createForm('AppBundle\Form\TiendaType', $tienda);
        $formulario->handleRequest($request);
        
        if ($formulario->isValid()) {
            
            //encriptamos la contraseña
            $encoder = $this->get('security.encoder_factory')->getEncoder($tienda);
            $passwordCodificado = $encoder->encodePassword(
                                             $tienda->getPasswordEnClaro(), null);
            $tienda->setPassword($passwordCodificado);
            
            //guradamos el objeto modificado
            $em = $this->getDoctrine()->getManager();
            $em->persist($tienda);
            $em->flush();

            $this->addFlash('info', 'Los datos de tu perfil se han actualizado correctamente');

            return $this->redirectToRoute('extranet_portada');

        }
        
        return $this->render('extranet/perfil.html.twig', array(
                'tienda' => $tienda,
                'formulario' => $formulario->createView()
        ));
    }    

    
    
    
    
}
