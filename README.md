# ChatBot para soporte

## Descripción

ChatBot de Slack que se conecta con un LLM para apoyar el soporte a las comunidades.

## Requisitos

-   Node 18+
-   Slack Bolt
-   Dotenv

## Iniciar aplicación

```shell
npm start
```

## Información para contribuir

### **Estándares generales**

-   Para los commits, seguimos las normas detalladas en [este enlace](https://github.com/angular/angular.js/blob/master/DEVELOPERS.md#commits) 👀
-   Usamos inglés para los nombres de ramas y mensajes de commit 💬
-   Todas las fusiones a la rama principal se realizan a través de solicitudes de Pull Request(PR) ⬇️
-   Puedes emplear tokens como "WIP" en el encabezado de un commit, separados por dos puntos (:), por ejemplo: "WIP: este es un mensaje de commit útil ✅"
-   Las ramas de nuevas funcionalidades que no han sido fusionada, se asume que no está finalizada⚠️
-   Los nombres de las ramas deben estar en minúsculas y las palabras deben separarse con guiones (-) 🔤
-   Los nombres de las ramas deben comenzar con uno de los tokens abreviados definidos. Por ejemplo: feat/tokens-configurations 🌿

### **Short lead tokens**

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

#### Flujo de trabajo

1. Crea tu rama desde develop.
2. Haz un push de los commits y publica la nueva rama.
3. Abre un Pull Request apuntando tus cambios a develop.
4. Espera a la revisión de los demás integrantes del equipo.
5. Mezcla los cambios sólo cuando esté aprobado por mínimo 2 revisores.

### Esquema de flujo

![gitflow](https://wac-cdn.atlassian.com/dam/jcr:cc0b526e-adb7-4d45-874e-9bcea9898b4a/04%20Hotfix%20branches.svg?cdnVersion=1324)

### **Reglas** 📖

1. Todo PR debe incluir test.
2. Todo PR debe cumplir con un mínimo de 80% de coverage para ser aprobado
3. El PR debe tener 2 o más aprobaciones para poder mezclarse.
4. Si un commit revierte un commit anterior deberá comenzar con "revert:" seguido del mensaje del commit anterior.

### **Pull Request**

-   Usar un lenguaje imperativo y en tiempo presente: "change" no "changed" ni "changes".
-   El titulo del los PR y mensajes de commit no pueden comenzar con una letra mayúscula.
-   No se debe usar punto final en los títulos o descripción de los commits.
-   El titulo del PR debe comenzar con el short lead token definido para la rama, seguido de : y una breve descripción del cambio.
-   La descripción del PR debe detallar los cambios.
-   La descripción del PR debe incluir evidencias de que los test se ejecutan de forma correcta.
-   Se pueden usar gif o videos para complementar la descripción o evidenciar el funcionamiento del PR.
