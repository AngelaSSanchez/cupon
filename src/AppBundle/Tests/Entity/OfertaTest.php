<?php

namespace AppBundle\Tests\Entity;

use Symfony\Component\Validator\Validation;
use AppBundle\Entity\Oferta;

class OfertaTest extends \PHPUnit_Framework_TestCase {

    private $validator;

    protected function setUp() {
        $this->validator = Validation::createValidatorBuilder()
                ->enableAnnotationMapping()
                ->getValidator();
    }

    public function testValidarSlug() {
        $oferta = new Oferta();
        $oferta->setNombre('Oferta de prueba');
        $slug = $oferta->getSlug();
        $this->assertEquals('oferta-de-prueba', $slug, 'El slug se asigna automáticamente a partir del nombre');
    }

    

    public function testValidarDescripcion() {
        $oferta = new Oferta();
        
        $oferta->setNombre('Oferta de prueba');
        $listaErrores = $this->validator->validate($oferta);
        $this->assertGreaterThan(0, $listaErrores->count(), 'La descripción no puede dejarse en blanco');
        $error = $listaErrores[0];
        $this->assertEquals('This value should not be blank.', $error->getMessage());
        $this->assertEquals('descripcion', $error->getPropertyPath());
        
        $oferta->setNombre('');
        $listaErrores = $this->validator->validate($oferta);
        $this->assertGreaterThan(0, $listaErrores->count(), 'La descripción no puede dejarse en blanco');
        $error = $listaErrores[0];
        $this->assertEquals('This value should not be blank.', $error->getMessage());
        $this->assertEquals('nombre', $error->getPropertyPath());
        
        $oferta->setDescripcion('Descripción de prueba');
        $listaErrores = $this->validator->validate($oferta);
        $this->assertGreaterThan(0, $listaErrores->count(), 'La descripción debe tener al menos 30 caracteres');
        $error = $listaErrores[0];
        $this->assertRegExp("/This value is too short/", $error->getMessage());
        $this->assertEquals('descripcion', $error->getPropertyPath());
    }

}
