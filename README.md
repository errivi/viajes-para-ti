# Prueba Técnica - Viajes Para Ti ✈️

Proyecto desarrollado con **Symfony 6.4 LTS** para la gestión de proveedores.

El objetivo es ofrecer una herramienta rápida y sencilla para el departamento de contabilidad, permitiendo gestionar el ciclo de vida de los proveedores (CRUD) con una interfaz amigable y responsive.

## 🛠️ Tecnologías Utilizadas

* **Backend:** PHP 8.2, Symfony 6.4, Doctrine ORM.
* **Base de Datos:** MySQL.
* **Frontend:** Twig, Bootstrap 5 (Responsive Design).
* **Infraestructura:** Docker & Docker Compose.

## 🚀 Instalación y Despliegue

Puedes desplegar el proyecto de dos formas: usando Docker (recomendado) o en un entorno local clásico.

### Opción A: Despliegue con Docker 🐳 (Recomendada)

El proyecto incluye una configuración completa de contenedores.

1.  **Levantar los servicios:**
    ```bash
    docker compose up -d --build
    ```
2.  **Preparar la base de datos** (Solo la primera vez):
    ```bash
    docker compose exec app php bin/console doctrine:migrations:migrate
    ```
3.  **Acceder a la aplicación:**
    La web estará disponible en: **http://localhost:8080/index.php/proveedores**

> **⚠️ Nota sobre Rendimiento en Windows:**
> Si ejecuta este proyecto en Docker Desktop para Windows montando el volumen desde el sistema de archivos NTFS, es posible que note tiempos de carga elevados en modo desarrollo. Esto es un comportamiento conocido (I/O Overhead) entre Windows y WSL2. En entornos Linux nativos o Producción, la aplicación funciona a velocidad nativa instantánea.

---

### Opción B: Instalación Local (Symfony CLI) 💻

Si prefieres usar tu propio servidor local (requiere PHP y MySQL instalados):

1.  **Clonar el repositorio e instalar dependencias:**
    ```bash
    git clone <URL_DEL_REPOSITORIO>
    cd viajes-para-ti
    composer install
    ```
2.  **Configurar Entorno:**
    * Crea un archivo `.env` local (`cp .env.example .env`).
    * Configura `DATABASE_URL` con tus credenciales.
3.  **Base de Datos:**
    ```bash
    php bin/console doctrine:database:create
    php bin/console doctrine:migrations:migrate
    ```
4.  **Iniciar Servidor:**
    ```bash
    symfony server:start
    ```
    Accede a: **http://127.0.0.1:8000/proveedores**

## ✅ Funcionalidades Implementadas

* **Gestión de Proveedores:** Crear, Listar, Editar y Eliminar (CRUD).
* **Validaciones:** Control de tipos de datos y campos obligatorios.
* **Seguridad:** Borrado mediante formulario con Token CSRF (protección contra ataques).
* **Diseño:** Interfaz adaptada a móviles y tablets.
* **Fechas Automáticas:** Gestión transparente de `fechaCreacion` y `fechaActualizacion`.

---
*Prueba realizada por Eric Riveiro para el proceso de selección.*