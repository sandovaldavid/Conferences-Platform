# DevWebCamp - Plataforma de Gestión de Conferencias

## Descripción
DevWebCamp es una plataforma web completa para la gestión y organización de conferencias y eventos virtuales/presenciales. Permite a los usuarios registrarse, seleccionar conferencias y administrar su participación en diversos eventos.

## Características Principales
- Sistema de autenticación de usuarios
- Panel de administración completo
- Gestión de conferencias y eventos
- Registro de participantes
- Sistema de pagos integrado con PayPal
- Generación de pases virtuales
- Dashboard con estadísticas en tiempo real

## Tecnologías Utilizadas
- PHP 8.0
- MySQL
- JavaScript
- SASS
- Gulp
- Node.js
- PayPal API

## Configuración del Entorno
1. Clonar el repositorio
2. Configurar el archivo `.env` con las siguientes variables:
```
DB_HOST=localhost
DB_USER=tu_usuario
DB_PASS=tu_password
DB_NAME=devwebcamp

EMAIL_HOST=smtp.mailtrap.io
EMAIL_PORT=tu_port_mailtrap
EMAIL_USER=tu_usuario_mailtrap
EMAIL_PASS=tu_password_mailtrap

HOST=http://localhost:3000
```

## Instalación
1. Ejecutar `composer install` para instalar dependencias PHP
2. Ejecutar `npm install` para instalar dependencias de Node.js
3. Importar la base de datos desde el archivo SQL proporcionado
4. Configurar el servidor virtual en Apache/Nginx
5. Compilar assets con `gulp`

## Estructura del Proyecto
```
devwebcamp/
├── classes/         # Clases principales del sistema
├── includes/        # Configuraciones y funciones helpers
├── public/          # Archivos públicos y entrada principal
├── src/            # Archivos fuente (SASS, JS)
├── templates/      # Plantillas del sitio
└── vendor/         # Dependencias de Composer
```

## Funcionalidades
- Registro y autenticación de usuarios
- Gestión de eventos y conferencias
- Sistema de pagos seguro
- Área administrativa
- Reportes y estadísticas
- Gestión de ponentes
- Control de asistencia

## Seguridad
- Protección contra CSRF
- Sanitización de datos
- Passwords hasheados con Bcrypt
- Validación de formularios
- Control de sesiones

## Contacto
Para soporte técnico: [email@ejemplo.com]

## Notas de Desarrollo
- Usar gulp watch durante el desarrollo
- Puerto de desarrollo: 3200
- Configurar correctamente los permisos de carpetas
