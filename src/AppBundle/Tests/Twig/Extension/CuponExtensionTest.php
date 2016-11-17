<?php

namespace AppBundle\Tests\Twig\Extension;

use AppBundle\Twig\Extension\CuponExtension;

/**
 * Test unitario para asegurar el buen funcionamiento de la extensión
 * propia de Twig.
 */
class CuponExtensionTest extends \PHPUnit_Framework_TestCase {

    public function testDescuento() 
    {
        $extension = new CuponExtension();

        $this->assertEquals('-', $extension->descuento(100, 'hola'), "Probardo que es descuento es numerico.");

        $this->assertEquals('-', $extension->descuento(null, 100), "Probardo que el precio es numerico.");

        $this->assertEquals('0%', $extension->descuento(100, 0), "Probardo el descuento de 0% si es 0.");

        $this->assertEquals('0%', $extension->descuento(100, null), "Probardo el descuento de 0% si es Null.");

        $this->assertEquals('-80%', $extension->descuento(2, 8), "Probardo el descuento es de 80%");

        $this->assertEquals('-33.33%', $extension->descuento(10, 5, 2), "Probardo el descuento es del 33% con dos decimales.");
    }

    public function testMostrarComoLista() 
    {
        $fixtures = __DIR__.'/fixtures/lista';
        $extension = new CuponExtension();
        $original = file_get_contents($fixtures.'/original.txt');
        $this->assertEquals(file_get_contents($fixtures.'/esperado-ul.txt'), 
                $extension->mostrarComoLista($original));
        $this->assertEquals(file_get_contents($fixtures.'/esperado-ol.txt'), 
                $extension->mostrarComoLista($original, 'ol')
        );
    }

}
