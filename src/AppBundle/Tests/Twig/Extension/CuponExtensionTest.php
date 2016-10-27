<?php

namespace AppBundle\Tests\Twig\Extension;

use AppBundle\Twig\Extension\CuponExtension;

/**
 * Test unitario para asegurar el buen funcionamiento de la extensión
 * propia de Twig.
 */
class CuponExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testPrueba()
    {
        $extension = new CuponExtension();
        
        $this->assertEquals('-',$extension->descuento(100,'hola'), "Probar que el descuento es numérico");
        $this->assertEquals('-',$extension->descuento(null,20), "Probar que el precio es numérico");
        $this->assertEquals('0%',$extension->descuento(100,0), "Probar que el descuento es 0");
       // $this->assertEquals('0%',$extension->descuento(100,null), "Probar que el descuento es null");
        $this->assertEquals('-80%',$extension->descuento(2,8), "Probar que el descuento es del 80%");
        $this->assertEquals('-33.33%',$extension->descuento(10,5,2), "Probar que el descuento es del 80%");
    }

    public function testMostrarComoLista(){
         $fixtures = __DIR__.'/fixtures/lista';
        $extension = new CuponExtension();
        $original = file_get_contents($fixtures.'/original.txt');
        $this->assertEquals(file_get_contents($fixtures.'/esperado-ul.txt'), 
                $extension->mostrarComoLista($original));
        $this->assertEquals(file_get_contents($fixtures. '/esperado-ol.txt'), 
                $extension->mostrarComoLista($original, 'ol')
        );
    }
}
