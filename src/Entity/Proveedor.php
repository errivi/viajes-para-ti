<?php

namespace App\Entity;

use App\Repository\ProveedorRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: ProveedorRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Ya existe un proveedor con este email.')]
class Proveedor
{
    // Definimos listado de tipos permitidos
    public const TIPOS = ['Hotel', 'Crucero', 'Estación de esquí', 'Parque temático'];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'El email no puede estar vacío.')]
    #[Assert\Email(message: 'El formato del correo {{ value }} no es válido.')] // Valida que tenga @ y punto
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'El teléfono es obligatorio.')]
    #[Assert\Regex(
        pattern: '/^\d+$/',
        message: 'El teléfono solo puede contener números.'
    )] // Valida que solo haya dígitos del 0 al 9
    #[Assert\Length(
        min: 9, 
        max: 15, 
        minMessage: 'El teléfono debe tener al menos 9 dígitos',
        maxMessage: 'El teléfono es demasiado largo'
    )]
    private ?string $telefono = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: 'Debes seleccionar un tipo de proveedor.')]
    #[Assert\Choice(choices: self::TIPOS, message: 'El tipo seleccionado no es válido.')]
    private ?string $tipo = null;

    #[ORM\Column]
    private ?bool $activo = null;

    #[ORM\Column]
    private ?\DateTime $fechaCreacion = null;

    #[ORM\Column]
    private ?\DateTime $fechaActualizacion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): static
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): static
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function isActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(bool $activo): static
    {
        $this->activo = $activo;

        return $this;
    }

    public function getFechaCreacion(): ?\DateTime
    {
        return $this->fechaCreacion;
    }

    public function setFechaCreacion(\DateTime $fechaCreacion): static
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    public function getFechaActualizacion(): ?\DateTime
    {
        return $this->fechaActualizacion;
    }

    public function setFechaActualizacion(\DateTime $fechaActualizacion): static
    {
        $this->fechaActualizacion = $fechaActualizacion;

        return $this;
    }
}
