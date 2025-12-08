# Prueba Técnica - Viajes Para Ti ✈️

Proyecto desarrollado con **Symfony 6.4 LTS** para la gestión de proveedores.

El objetivo es ofrecer una herramienta rápida y sencilla para el departamento de contabilidad, permitiendo gestionar el ciclo de vida de los proveedores (CRUD) con una interfaz amigable y responsive.

## 🛠️ Tecnologías Utilizadas

* **Backend:** PHP 8.2, Symfony 6.4, Doctrine ORM.
* **Base de Datos:** MySQL 8.
* **Frontend:** Twig, Bootstrap 5 (Responsive Design).
* **Infraestructura:** Docker & Docker Compose.

## 📸 Vistas de la Aplicación

| Listado (Escritorio) | Formulario de Creación/Edición |
| -------------------- | ---------------------- |
| ![Listado](assets/listado.jpg) | ![Formulario](assets/formulario.jpg) |

*(La aplicación es totalmente responsive y adaptable a móviles)*

## 🚀 Instalación y Despliegue

### Opción A: Despliegue con Docker 🐳 (Recomendada)

Este método garantiza que la aplicación funcione en un entorno aislado idéntico al de desarrollo.

1.  **Levantar los servicios:**
    ```bash
    docker compose up -d --build
    ```

2.  **Instalar dependencias y preparar Base de Datos:**
    *(Ejecutar estos comandos una vez el contenedor esté en marcha)*
    ```bash
    # Instalar librerías de PHP (evita problemas de volúmenes vacíos)
    docker compose exec app composer install

    # Crear tablas en la base de datos
    docker compose exec app php bin/console doctrine:migrations:migrate
    ```

3.  **Acceder a la aplicación:**
    👉 **http://localhost:8080/index.php/proveedores**

> **⚠️ Nota sobre Rendimiento en Windows:**
> Si ejecuta este proyecto en Docker Desktop para Windows montando el volumen desde NTFS, es posible que note tiempos de carga elevados en modo desarrollo debido al overhead de I/O. En entornos Linux nativos, la aplicación funciona a velocidad instantánea.

---

### Opción B: Instalación Local (Manual) 💻

Si prefiere usar su propio servidor local (requiere PHP 8.2+ y MySQL):

1.  **Clonar e instalar:**
    ```bash
    git clone <URL_REPO>
    cd viajes-para-ti
    composer install
    ```
2.  **Configurar:** Copia `.env.example` a `.env` y ajusta `DATABASE_URL`.
3.  **Base de Datos:**
    ```bash
    php bin/console doctrine:database:create
    php bin/console doctrine:migrations:migrate
    ```
4.  **Iniciar Servidor:**
    ```bash
    php -S 127.0.0.1:8000 -t public
    ```
    Accede a: **http://127.0.0.1:8000/proveedores**