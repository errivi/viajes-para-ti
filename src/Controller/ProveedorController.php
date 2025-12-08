<?php

namespace App\Controller;

use App\Entity\Proveedor;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class ProveedorController extends AbstractController
{
    #[Route('/proveedores', name: 'app_proveedores')]
    public function index(\Symfony\Component\HttpFoundation\Request $request, EntityManagerInterface $entityManager): Response
    {
        $busqueda = $request->query->get('q'); // Obtiene lo que hay en ?q=...
        $repository = $entityManager->getRepository(Proveedor::class);

        if ($busqueda) {
            // Consulta avanzada con QueryBuilder para buscar por nombre O email O tipo
            $proveedores = $repository->createQueryBuilder('p')
                ->where('p.nombre LIKE :val')
                ->orWhere('p.email LIKE :val')
                ->orWhere('p.tipo LIKE :val')
                ->setParameter('val', '%' . $busqueda . '%')
                ->orderBy('p.id', 'DESC')
                ->getQuery()
                ->getResult();
        } else {
            // Si no hay búsqueda, traer todos (ordenados por ID descendente para ver los nuevos primero)
            $proveedores = $repository->findBy([], ['id' => 'DESC']);
        }

        return $this->render('proveedor/index.html.twig', [
            'proveedores' => $proveedores,
            'busqueda' => $busqueda, // Pasamos el término para pintarlo en el input
        ]);
    }

    #[Route('/proveedor/nuevo', name: 'app_proveedor_new')]
    public function new(\Symfony\Component\HttpFoundation\Request $request, EntityManagerInterface $entityManager): Response
    {
        // 1. Crear una instancia vacía de la entidad
        $proveedor = new Proveedor();
        
        // 2. Crear el formulario asociado a esa instancia
        $form = $this->createForm(\App\Form\ProveedorType::class, $proveedor);
        
        // 3. Procesar la petición (mirar si el usuario envió datos)
        $form->handleRequest($request);

        // 4. Si el formulario se envió y es válido...
        if ($form->isSubmitted() && $form->isValid()) {
            
            // Asignamos las fechas automáticas (requisito del sistema)
            $proveedor->setFechaCreacion(new \DateTime());
            $proveedor->setFechaActualizacion(new \DateTime());

            // Guardamos en Base de Datos
            $entityManager->persist($proveedor); // "Prepara este objeto"
            $entityManager->flush();             // "Ejecuta el SQL INSERT"
            $this->addFlash('success', '¡Proveedor creado con éxito!');

            // Redirigimos al listado para ver el resultado
            return $this->redirectToRoute('app_proveedores');
        }

        // 5. Si no se envió (o falló), mostrar el formulario
        return $this->render('proveedor/new.html.twig', [
            'form' => $form, // Pasamos el formulario a la vista
        ]);
    }
    #[Route('/proveedor/{id}/editar', name: 'app_proveedor_edit')]
    public function edit(\Symfony\Component\HttpFoundation\Request $request, Proveedor $proveedor, EntityManagerInterface $entityManager): Response
    {
        // Symfony busca automáticamente el proveedor por su ID gracias al parámetro (Proveedor $proveedor)
        
        $form = $this->createForm(\App\Form\ProveedorType::class, $proveedor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Actualizamos solo la fecha de modificación 
            $proveedor->setFechaActualizacion(new \DateTime());

            // No hace falta persist() porque el objeto ya existe, solo flush()
            $entityManager->flush();
            $this->addFlash('success', '¡Proveedor actualizado con éxito!');

            return $this->redirectToRoute('app_proveedores');
        }

        return $this->render('proveedor/edit.html.twig', [
            'form' => $form,
            'proveedor' => $proveedor,
        ]);
    }
    #[Route('/proveedor/{id}/borrar', name: 'app_proveedor_delete', methods: ['POST'])]
    public function delete(\Symfony\Component\HttpFoundation\Request $request, Proveedor $proveedor, EntityManagerInterface $entityManager): Response
    {
        // Verificamos el token de seguridad para confirmar que el usuario realmente quiso borrar
        if ($this->isCsrfTokenValid('delete'.$proveedor->getId(), $request->request->get('_token'))) {
            $entityManager->remove($proveedor);
            $entityManager->flush();
            $this->addFlash('success', '¡Proveedor borrado con éxito!');
        }

        return $this->redirectToRoute('app_proveedores');
    }
}