<?php

namespace App\DataFixtures;

use App\Entity\Proveedor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $nombres = ['Viajes Mundo', 'Hotel Paradiso', 'Cruceros del Sol', 'Aventura Park', 'Ski Andorra', 'Resort Blue', 'Theme Land', 'Ocean View', 'Montaña Mágica', 'City Tours'];
        
        for ($i = 0; $i < 10; $i++) {
            $proveedor = new Proveedor();
            $proveedor->setNombre($nombres[$i] ?? 'Proveedor ' . $i);
            $proveedor->setEmail('contacto' . $i . '@ejemplo.com');
            $proveedor->setTelefono('60012300' . $i);
            
            // Asignamos tipos rotatorios
            $tipos = Proveedor::TIPOS;
            $proveedor->setTipo($tipos[$i % count($tipos)]);
            
            $proveedor->setActivo((bool)rand(0, 1)); 
            $proveedor->setFechaCreacion(new \DateTime());
            $proveedor->setFechaActualizacion(new \DateTime());

            $manager->persist($proveedor);
        }

        $manager->flush();
    }
}