<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Ciudad;
use AppBundle\Entity\Oferta;
use AppBundle\Entity\Tienda;
use AppBundle\Entity\Usuario;
use AppBundle\Entity\Venta;

class DefaultController extends Controller
{
//    /**
//     * @Route("/", name="homepage")
//     */
//    public function indexAction(Request $request)
//    {
//        // replace this example code with whatever you need
//        return $this->render('default/index.html.twig', array(
//            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
//        ));
//    }
    
//    /**
//     * @Route("/ayuda")
//     */
//    public function ayudaAction()
//    {
//        
//        return new Response('<html><body>En que te puedo ayudar !</body></html>');
//    }
    
//    /**
//     * @Route("/ayuda")
//     */
//    public function ayudaAction()
//    {
//        
//        return $this->render('sitio/ayuda.html.twig');
//    }
//    
//    
//    /**
//     * @Route("/{ciudad}", defaults={ "ciudad" = "Madrid" }, name="portada")
//     *
//     * Muestra la portada del sitio web.
//     *
//     * @param string $ciudad El slug de la ciudad activa en la aplicación
//     *
//     * @return Response
//     */
//    public function portadaAction($ciudad)
//    {
//        //buscar la ciudad cuyo id es 6++++++++++++++++++++++++++
//        $em = $this->getDoctrine()->getManager();
//        $pruebas = $em->getRepository('AppBundle:Ciudad')->find(56);
//        var_dump($pruebas);
//        die();
        
        //buscar todas las ciudades+++++++++++++++++++++++++++++++++++++++
//        $pruebas = $em->getRepository('AppBundle:Ciudad')->findAll();
//        foreach ($pruebas as $dato){
//            echo $dato->getNombre().'<br>';
//        }
//        return new Response('<html><body></body></html>');
        
        //buscar nombre y apellidos de todos los usuarios++++++++++++++++++
//        $usuarios = $em->getRepository('AppBundle:Usuario')->findAll();
//        foreach ($usuarios as $usuario){
//            echo $usuario->getNombre().' '.$usuario->getApellidos().'<br>';
//        }
//      
//        return new Response('<html><body></body></html>');
        
        
        //buscar nombre y apellidos y ciudad de todos los usuarios++++++++++++++++++
//        $usuarios = $em->getRepository('AppBundle:Usuario')->findAll();
//        foreach ($usuarios as $usuario){
//            echo $usuario->getNombre().' '.$usuario->getApellidos().' es de '.$usuario->getCiudad()->getNombre().'<br>';
//        }
//      
//        return new Response('<html><body></body></html>');
        
        
        //buscar con find by++++++++++++++++++
////        $ofertas = $em->getRepository('AppBundle:Oferta')->findBy(array('revisada'=>true));
//        $ofertas = $em->getRepository('AppBundle:Oferta')->findByRevisada(true);
//        foreach ($ofertas as $oferta){
//            echo $oferta->getNombre().' '.$oferta->getPrecio().'<br>';
//        }
//      
//        return new Response('<html><body></body></html>');
        
        
        
        //buscar la oferta 1+++++++++++++++++
//        $pruebas = $em->find('AppBundle:Oferta',1);
//
//        echo $pruebas->getNombre().'<br>';
//        echo $pruebas->getDescripcion().'<br>';
//        echo $pruebas->getPrecio().'<br>';
//
//        return new Response('<html><body></body></html>');
 
        
        //Modificar oferta 1+++++++++++++++++
//        $oferta = $em->find('AppBundle:Oferta',1);
//
//        $oferta->setNombre('Oferta #1 Cena en Restaurante ComoTodito');
//        $oferta->setPrecio($oferta->getPrecio()+5);
//        $em->flush();
//        
//        echo $oferta->getNombre().'<br>';
//        echo $oferta->getDescripcion().'<br>';
//        echo $oferta->getPrecio().'<br>';
//
//        return new Response('<html><body></body></html>');
        
        //Insertar oferta +++++++++++++++++
//        $oferta = new Oferta();
//        $oferta->setNombre('Oferta X - Todo Barato Barato'); 
//        $oferta->setSlug('barato_barato');
//        $oferta->setDescripcion('Lorem Ipsum ...');
//        $oferta->setCondiciones('Lorem Ipsum ...');
//        $oferta->setRutaFoto('Lorem Ipsum ...');
//        $oferta->setPrecio(10.99); // ... completar todas las propiedades ...
//        $oferta->setDescuento(0);
//        $oferta->setfechaPublicacion(new \DateTime('2016-12-24 00:00:00'));
//        $oferta->setFechaExpiracion(new \DateTime('2016-12-24 00:00:00'));
//        $oferta->setUmbral(0);
//
//        $ciudad = $em->getRepository('AppBundle:Ciudad')->find(56);
//        $oferta->setCiudad($ciudad);
//
//        $em->persist($oferta);
//        $em->flush();
//        
//        $ofertas = $em->getRepository('AppBundle:Oferta')->findAll();
//        foreach ($ofertas as $oferta){
//            echo $oferta->getNombre().' '.$oferta->getPrecio().'<br>';
//        }    
//        
//        return new Response('<html><body></body></html>');
 
        //Borrar oferta +++++++++++++++++

        
//        $ofertas = $em->getRepository('AppBundle:Oferta')->findAll();
//        foreach ($ofertas as $oferta){
//            echo $oferta->getId().' '.$oferta->getNombre().' '.$oferta->getPrecio().'<br>';
//        }    
//        
//        $ofertaBorrar = $em->getRepository('AppBundle:Oferta')->find(252);
//        $em->remove($ofertaBorrar);
//        $em->flush();
//        
//        return new Response('<html><body></body></html>');
// 
//    }
    
    /**
     * @Route("/sitio/{nombrePagina}", defaults={ "nombrePagina"="ayuda" }, name="pagina")
     */
    public function paginaAction($nombrePagina, Request $request)
    {
        
        return $this->render(sprintf('sitio/%s/%s.html.twig',
                                    $request->getLocale(),
                                    $nombrePagina));
    }   
    
    
    /**
     * @Route("/{ciudad}", name="portada", defaults={"ciudad" = "%app.ciudad_por_defecto%"})
     *
     * Muestra la portada del sitio web.
     *
     * @return Response
     *
     * @throws NotFoundHttpException
     */
    public function portadaAction($ciudad )
    {
        
        $em = $this->getDoctrine()->getManager();
        $oferta = $em->getRepository('AppBundle:Oferta')->findOfertaDelDia($ciudad);

        if (!$oferta) {
            throw $this->createNotFoundException('No se ha encontrado ninguna oferta del día en la ciudad seleccionada');
        }

        return $this->render('portada.html.twig', array(
            'oferta' => $oferta,
        ));
    }
   
    
 /**
     * @Route("/pruebas/{ciudad}", name="pruebas")
     */
    public function pruebasAction($ciudad, Request $request)
    {
        //        localhost:8000/app_dev.php?XDEBUG_SESSION_START=netbeans-xdebug
        
        // aquí ya está disponible la variable $request
        // con toda la información de la petición del usuario

        // Obtener el valor del parámetro GET llamado 'ciudad'
        // $ciudad valdrá 'null' si no existe el parámetro 'ciudad'

        $ciudad = $request->query->get('ciudad');
        // Mismo ejemplo, pero asignando un valor por defecto por si
        // no existe el parámetro de tipo GET llamado 'ciudad'
        $ciudad = $request->query->get('ciudad', 'paris');

        // Obtener el valor del parámetro POST llamado 'ciudad'
        // $ciudad valdrá 'null' si no existe el parámetro 'ciudad'
        $ciudad = $request->request->get('ciudad');

        // Mismo ejemplo, pero asignando un valor por defecto por si
        // no existe el parámetro de tipo POST llamado 'ciudad'
        $ciudad = $request->request->get('ciudad', 'paris');

        // Saber qué navegador utiliza el usuario mediante la cabecera HTTP_USER_AGENT
        $navegador = $request->server->get('HTTP_USER_AGENT');

        // Mismo ejemplo, pero más fácil directamente a través de las cabeceras
        $navegador = $request->headers->get('user-agent');

        // Obtener el nombre de todas las cabeceras enviadas
        $cabeceras = $request->headers->keys();
        
         // Obtener array con todos los parametros
        $cabeceras = $request->headers->all();

        // Saber si se ha enviado una cookie de sesión
        $hayCookieSesion = $request->cookies->has('PHPSESSID');
        
        // La clase Request también incluye un método llamado get() que obtiene
        //  el valor del parámetro cuyo nombre se indica como argumento. Este
        //   parámetro se busca, por este orden, en las variables
        //$_GET, $_SERVER['PATH_INFO'], y $_POST:

        $ciudad2 = $request->get('ciudad');
        
//        Devuelve el nombre en mayúsculas del método utilizado para la petición (GET, POST, PUT, DELETE). 
        $metod = $request->getMethod();

//        Devuelve la URI de la petición. Ejemplo: /madrid
        $uri = $request->getRequestUri();
        
//        Devuelve el esquema utilizado (http o https)
        $scheme = $request->getScheme();
                
//        Devuelve el host de la URI. Ejemplo: cupon.local localhost
        $host = $request->getHost();         

//        Devuelve la dirección IP del usuario que ha realizado la petición. Si el usuario se encuentra detrás de un proxy, busca su dirección en los parámetros
        $ip = $request->getClientIp();
        
//        Devuelve un array con el código de los idiomas preferidos por el usuario y ordenados por importancia
        $idioma =  $request->getLanguages();
        
//        Devuelve el formato de la petición en minúsculas
        $format =  $request->getRequestFormat();
        
        
        

        
        
    } 
    
    
    
}
