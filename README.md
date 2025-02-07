# DevWebCamp - Plataforma de Gestión de Conferencias

## Descripción
DevWebCamp es una plataforma web completa para la gestión y organización de conferencias y eventos virtuales/presenciales. El sistema permite la administración integral de eventos tecnológicos, incluyendo registro de usuarios, gestión de ponentes, control de pagos y generación de reportes estadísticos.

## Características Principales
- Sistema de autenticación de usuarios con múltiples roles
- Panel de administración completo con interfaz intuitiva
- Gestión de conferencias y eventos con calendario integrado
- Registro de participantes con validación de cupos
- Sistema de pagos integrado con PayPal (sandbox y producción)
- Generación de pases virtuales con códigos QR
- Dashboard con estadísticas en tiempo real y reportes exportables

## Tecnologías Utilizadas
### Backend
- PHP 8.0
  - POO y MVC
  - Composer para gestión de dependencias
  - Sistema de routing personalizado
- MySQL
  - Queries optimizados
  - Transacciones para operaciones críticas
  
### Frontend
- JavaScript
  - ES6+
  - Fetch API
  - Módulos
- SASS
  - Arquitectura 7-1
  - Variables y mixins personalizados
- Gulp
  - Automatización de tareas
  - Optimización de assets
- Node.js
  - Gestión de dependencias frontend
  - Scripts de desarrollo

### APIs y Servicios
- PayPal API para pagos
- Mailtrap para emails en desarrollo
- API de códigos QR
- Sweetalert2 para notificaciones

## Requisitos del Sistema
- PHP >= 8.0
- MySQL >= 5.7
- Node.js >= 14.0
- NPM >= 6.0
- Apache/Nginx
- Composer
- Extensiones PHP:
  - PDO
  - MySQLi
  - cURL
  - GD

## Configuración del Entorno
1. Clonar el repositorio
```bash
git clone [url-repositorio]
cd devwebcamp
```

2. Configurar el archivo `.env`:
```properties
# Database
DB_HOST=localhost
DB_USER=tu_usuario
DB_PASS=tu_password
DB_NAME=devwebcamp

# Email
EMAIL_HOST=smtp.mailtrap.io
EMAIL_PORT=tu_port_mailtrap
EMAIL_USER=tu_usuario_mailtrap
EMAIL_PASS=tu_password_mailtrap

# URL
HOST=http://localhost:3000
```

## Instalación Paso a Paso
1. Instalar dependencias PHP:
```bash
composer install
```

2. Instalar dependencias Node.js:
```bash
npm install
```

3. Configurar la base de datos:
- Crear base de datos 'devwebcamp'
- Importar archivo SQL desde /database/devwebcamp.sql

4. Configurar servidor virtual:
```apache
<VirtualHost *:80>
    DocumentRoot "/ruta/al/proyecto/public"
    ServerName devwebcamp.local
    <Directory "/ruta/al/proyecto/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

5. Compilar assets:
```bash
gulp
```

## Estructura del Proyecto Detallada
```
devwebcamp/
├── classes/                    # Clases principales del sistema
│   ├── Database.php           # Gestión de conexión a base de datos
│   ├── Email.php              # Manejo de envío de correos
│   ├── Paginacion.php         # Sistema de paginación
│   ├── ActiveRecord.php       # Clase base para modelos
│   ├── EventosController.php  # Controlador de eventos
│   └── Modelos/              # Modelos del sistema
│       ├── Usuario.php        # Modelo de usuarios
│       ├── Evento.php        # Modelo de eventos
│       ├── Ponente.php       # Modelo de ponentes
│       └── Regalo.php        # Modelo de regalos
│
├── includes/                  # Archivos de configuración
│   ├── funciones.php         # Funciones helpers globales
│   ├── database.php          # Configuración de base de datos
│   ├── app.php              # Configuración general de la aplicación
│   └── .env                 # Variables de entorno
│
├── public/                   # Archivos públicos
│   ├── build/               # Assets compilados
│   │   ├── css/            # Estilos compilados
│   │   ├── js/             # JavaScript compilado
│   │   └── img/            # Imágenes optimizadas
│   ├── index.php           # Punto de entrada principal
│   └── uploads/            # Archivos subidos por usuarios
│       ├── ponentes/       # Fotos de ponentes
│       └── eventos/        # Imágenes de eventos
│
├── src/                     # Código fuente frontend
│   ├── js/                 # JavaScript modular
│   │   ├── app.js         # Entrada principal JS
│   │   ├── ponentes.js    # Lógica de ponentes
│   │   └── slider.js      # Componente slider
│   └── scss/              # Estilos SASS
│       ├── base/          # Estilos base
│       ├── components/    # Componentes reusables
│       ├── layout/        # Layouts principales
│       └── pages/         # Estilos específicos por página
│
├── templates/              # Plantillas y vistas
│   ├── admin/             # Vistas del panel admin
│   │   ├── dashboard/     # Sección dashboard
│   │   └── eventos/       # Gestión de eventos
│   ├── layout/           # Layouts principales
│   │   ├── header.php    # Encabezado común
│   │   └── footer.php    # Pie de página común
│   └── paginas/          # Páginas públicas
│       ├── inicio.php    # Página de inicio
│       └── conferencias/ # Vistas de conferencias
│
├── vendor/               # Dependencias de Composer
│
├── node_modules/        # Dependencias de Node.js
│
├── gulpfile.js         # Configuración de Gulp
├── package.json        # Dependencias y scripts npm
├── composer.json       # Dependencias PHP
└── .gitignore         # Archivos ignorados por git
```

### Descripción de Carpetas Principales

#### `/classes`
Contiene todas las clases PHP del sistema siguiendo el patrón MVC:
- Controladores para la lógica de negocio
- Modelos para interacción con la base de datos
- Clases utilitarias y servicios

#### `/includes`
Archivos de configuración y utilidades:
- Configuración de base de datos
- Variables de entorno
- Funciones helpers globales
- Autoloader de clases

## Funcionalidades Detalladas
### Sistema de Usuarios
- Registro con confirmación por email
- Recuperación de contraseñas
- Perfiles de usuario
- Roles y permisos

### Gestión de Eventos
- CRUD completo de conferencias
- Asignación de salas y horarios
- Control de capacidad
- Validación de conflictos

### Sistema de Pagos
- Integración PayPal
- Generación de facturas
- Historial de transacciones
- Reembolsos

### Área Administrativa
- Dashboard principal
- Gestión de usuarios
- Control de eventos
- Reportes PDF/Excel

## Seguridad
- Protección contra CSRF
- Sanitización de inputs
- Passwords hasheados con Bcrypt
- Validación de formularios
- Control de sesiones
- Rate limiting
- Headers de seguridad

## Desarrollo
### Comandos Útiles
```bash
# Modo desarrollo
gulp dev

# Compilar para producción
gulp build

# Vigilar cambios
gulp watch
```

### Debugging
- Error logging configurado
- Debug bar en desarrollo
- Manejo de excepciones personalizado

## Deployment
1. Configurar servidor producción
2. Ajustar variables .env
3. Compilar assets
4. Configurar SSL
5. Optimizar caché

## Contribución
1. Fork del repositorio
2. Crear feature branch
3. Commit cambios
4. Push al branch
5. Crear Pull Request

## Notas de Desarrollo
- Usar gulp watch durante el desarrollo
- Puerto de desarrollo: 3200
- Configurar correctamente los permisos de carpetas

