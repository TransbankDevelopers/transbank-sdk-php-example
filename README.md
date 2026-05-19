# Proyecto de Ejemplo SDK PHP

## Descripción

Proyecto de ejemplo mostrando el paso a paso de como usar el SDK PHP de transbank

## Requisitos

-   PHP 8.2+
-   Laravel 11
-   NODE 22.22.3
-   pnpm 11.1.1

## Desarrollo con Dev Container (recomendado)

La forma más rápida y consistente de empezar. Un contenedor preconfigurado con PHP 8.2, Composer, Node 22.22.3 y pnpm 11.1.1, sin necesidad de instalar nada en la máquina local más allá de Docker y VS Code.

### Requisitos del Dev Container

-   **Docker**
    -   **macOS:** [Docker Desktop](https://www.docker.com/products/docker-desktop/) o [OrbStack](https://orbstack.dev) (alternativa más liviana y con mejor rendimiento de I/O)
    -   **Linux / WSL2:** Docker Engine
-   **Visual Studio Code** con la extensión [Dev Containers](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-containers)

### Levantar el contenedor

1. Clonar el repositorio y abrirlo en VS Code.
2. VS Code detectará el directorio `.devcontainer/` y ofrecerá la opción **"Reopen in Container"** en la esquina inferior derecha. Si no aparece, abrir la paleta de comandos:
    - **macOS:** `Cmd + Shift + P`
    - **Linux / Windows:** `Ctrl + Shift + P`
    
    y buscar **"Dev Containers: Reopen in Container"**.
3. **La primera vez tarda entre 3 y 5 minutos** (descarga la imagen base y ejecuta el setup inicial). Las siguientes aperturas son inmediatas: VS Code reutiliza el contenedor existente.

Durante la creación inicial, el contenedor ejecuta automáticamente:
-   `composer install` (dependencias de PHP)
-   Copia de `.env.example` a `.env` y generación de la `APP_KEY` de Laravel
-   `php artisan migrate` (crea y migra la base SQLite)
-   `pnpm install` (dependencias de JavaScript)

### Ejecutar la aplicación

Se requieren **dos procesos en paralelo** dentro del contenedor. Abrir una terminal en VS Code (`` Ctrl + ` `` o `` Cmd + ` ``) y dividirla en dos paneles (`Ctrl + Shift + 5` o `Cmd + Shift + 5`).

**Terminal 1 — Servidor de Laravel:**

```bash
php artisan serve --host=0.0.0.0
```

**Terminal 2 — Bundler de Vite:**

```bash
pnpm run dev
```

Acceder desde el navegador a **http://localhost:8000**.

> El flag `--host=0.0.0.0` es necesario para que el port forwarding del Dev Container exponga el servidor al host. Sin él, Laravel solo escucha en el loopback interno del contenedor y la conexión no llega desde la máquina local.

### Notas para usuarios de macOS

-   **Arquitectura:** la imagen base soporta tanto Intel (x86_64) como Apple Silicon (arm64 — M1/M2/M3/M4). No requiere configuración adicional.
-   **Rendimiento del filesystem:** los bind mounts en Docker Desktop para Mac son más lentos que en Linux. Para este proyecto el impacto es mínimo, pero si se observa lentitud trabajando con `vendor/` o `node_modules/`, [OrbStack](https://orbstack.dev) ofrece mejor rendimiento de I/O sin cambios en el flujo de trabajo.
-   **Atajos de teclado:** en este README los `Ctrl` mostrados equivalen a `Cmd` en macOS.

### Solución de problemas frecuentes

**El build falla con error de firma GPG (Yarn / NO_PUBKEY)**  
Es un problema conocido de la imagen base de Microsoft, que incluye un repositorio de Yarn obsoleto. El `Dockerfile` ya lo mitiga eliminando ese archivo antes de `apt-get update`. Si el error persiste, ejecutar un rebuild sin caché desde la paleta de comandos: **"Dev Containers: Rebuild Container Without Cache"**.

**No es posible acceder a `http://localhost:8000` desde el navegador**  
Verificar que Laravel se haya iniciado con `--host=0.0.0.0` (no `127.0.0.1`). Si el problema continúa, revisar la pestaña **"Ports"** en VS Code para confirmar que el puerto 8000 está reenviado correctamente.

## Instalación

Una vez clonado el repositorio, instalar las dependencias del proyecto ejecutando los siguientes comandos en una terminal:

```bash
composer install
pnpm install
php artisan key:generate
php artisan migrate
```

> Este proyecto utiliza **pnpm** como gestor de paquetes de JavaScript. Si no está disponible localmente, puede habilitarse con `corepack enable pnpm` (incluido en Node.js 16 y superior).

## Ejecución

Para ejecutar el proyecto en modo desarrollo, utilizar los siguientes comandos en consolas separadas:

```bash
pnpm run dev
php artisan serve
```

Al iniciar, se mostrará la URL para acceder al proyecto. Un ejemplo de la URL puede ser **http://127.0.0.1:8000**.

## Información para contribuir a este proyecto

### Forma de trabajo

-   Para los mensajes de commits, nos basamos en las [Git Commit Guidelines de Angular](https://github.com/angular/angular.js/blob/master/DEVELOPERS.md#commits).
-   Usamos inglés para los nombres de ramas y mensajes de commit.
-   Los mensajes de commit no deben llevar punto final.
-   Los mensajes de commit deben usar un lenguaje imperativo y estar en tiempo presente, por ejemplo, usar "change" en lugar de "changed" o "changes".
-   Los nombres de las ramas deben estar en minúsculas y las palabras deben separarse con guiones (-).
-   Todas las fusiones a la rama principal se deben realizar mediante solicitudes de Pull Request(PR). ⬇️
-   Se debe emplear tokens como "WIP" en el encabezado de un commit, separados por dos puntos (:), por ejemplo, "WIP: this is a useful commit message".
-   Una rama con nuevas funcionalidades que no tenga un PR, se considera que está en desarrollo.
-   Los nombres de las ramas deben comenzar con uno de los tokens definidos. Por ejemplo: "feat/tokens-configurations".

### Short lead tokens permitidos

`WIP` = En progreso.

`feat` = Nuevos features.

`fix` = Corrección de un bug.

`docs` = Cambios solo de documentación.

`style` = Cambios que no afectan el significado del código. (espaciado, formateo de código, comillas faltantes, etc)

`refactor` = Un cambio en el código que no arregla un bug ni agrega una funcionalidad.

`perf` = Cambio que mejora el rendimiento.

`test` = Agregar test faltantes o los corrige.

`chore` = Cambios en el build o herramientas auxiliares y librerías.

`revert` = Revierte un commit.

`release` = Para liberar una nueva versión.

### Creación de un Pull Request

-   El PR debe estar enfocado en un cambio en concreto, por ejemplo, agregar una nueva funcionalidad o solucionar un error, pero un solo PR no puede agregar una nueva funcionalidad y arreglar un error.
-   El título del los PR y mensajes de commit no debe comenzar con una letra mayúscula.
-   No se debe usar punto final en los títulos.
-   El título del PR debe comenzar con el short lead token definido para la rama, seguido de ":"" y una breve descripción del cambio.
-   La descripción del PR debe detallar los cambios que se están incorporando.
-   La descripción del PR debe incluir evidencias de que los test se ejecutan de forma correcta o incluir evidencias de que los cambios funcionan y no afectan la funcionalidad previa del proyecto.
-   Se pueden agregar capturas, gif o videos para complementar la descripción o demostrar el funcionamiento del PR.

#### Flujo de trabajo

1. Crea tu rama desde develop.
2. Haz un push de los commits y publica la nueva rama.
3. Abre un Pull Request apuntando tus cambios a develop.
4. Espera a la revisión de los demás integrantes del equipo.
5. Para poder mezclar los cambios se debe contar con 2 aprobaciones de los revisores y no tener alertas por parte de las herramientas de inspección.

### Esquema de flujo con git

![gitflow](https://wac-cdn.atlassian.com/dam/jcr:cc0b526e-adb7-4d45-874e-9bcea9898b4a/04%20Hotfix%20branches.svg?cdnVersion=1324)

## Generar una nueva versión

Para generar una nueva versión, se debe crear un PR (con un título "release: prepare release X.Y.Z" con los valores que correspondan para `X`, `Y` y `Z`). Se debe seguir el estándar [SemVer](https://semver.org/lang/es/) para determinar si se incrementa el valor de `X` (si hay cambios no retrocompatibles), `Y` (para mejoras retrocompatibles) o `Z` (si sólo hubo correcciones a bugs). **El PR debe apuntar a la rama principal**.

En ese PR deben incluirse los siguientes cambios:

1. Modificar el archivo `CHANGELOG.md` agregando una nueva entrada al comienzo con los detalles de los cambios. Esta debe estar escrita en español. Esta entrada debe contener la versión que se esta liberando, la fecha de liberación y la descripción de los cambios realizados.
2. Actualizar el archivo `README.md` si corresponde.

Luego de obtener aprobación del PR y mezclarse, se debe generar de manera inmediata un release en GitHub con el tag `X.Y.Z`. En la descripción del release se debe agregar el mismo detalle que fue agregado al archivo `CHANGELOG.md`.

Una vez realizada la liberación, se debe mezclar la rama release en la rama develop, finalmente realizar un rebase de la rama develop utilizando como base la rama main.
