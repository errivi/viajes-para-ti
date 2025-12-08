<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProveedorControllerTest extends WebTestCase
{
    public function testElListadoFunciona(): void
    {
        $client = static::createClient();
        
        // Simula que un usuario entra en la web
        $crawler = $client->request('GET', '/proveedores');

        // Asegura que la web carga bien (Código 200 OK)
        $this->assertResponseIsSuccessful();
        
        // Asegura que aparece el título correcto
        $this->assertSelectorTextContains('h1', 'Gestión de Proveedores');
    }
}
