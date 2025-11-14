# Rentify - Sistema de Gestión de Alquileres

Una aplicación web moderna y escalable para administrar casas, apartamentos y locales de alquiler.

## 🎯 Características Principales

- **Autenticación y Roles**: Sistema de usuarios con roles (Admin y Colaborador)
- **Gestión de Propiedades**: CRUD completo para propiedades
- **Gestión de Inquilinos**: Administración de inquilinos con contacto
- **Reservas**: Sistema de reservas con fechas y precios
- **Transacciones**: Registro de ingresos y gastos por propiedad
- **Dashboard**: Panel estadístico con gráficos de Chart.js
- **Diseño Responsivo**: Interfaz moderna con TailwindCSS
- **Modo Oscuro**: Soporte completo para tema oscuro
- **Validaciones**: Validación robusta de formularios
- **Subida de Imágenes**: Sistema de carga de imágenes para propiedades

## 🚀 Instalación y Configuración

### Requisitos Previos
- PHP 8.1 o superior
- Composer
- Node.js y NPM
- SQLite o MySQL

### Paso 1: Clonar o Descargar el Proyecto

```bash
cd Rentify
```

### Paso 2: Instalar Dependencias

```bash
# Instalar dependencias PHP
composer install

# Instalar dependencias Node.js
npm install
```

### Paso 3: Configurar el Archivo `.env`

```bash
# Copiar archivo de ejemplo
cp .env.example .env

# Generar clave de aplicación
php artisan key:generate
```

Edita el archivo `.env` y configura tu base de datos:

```env
DB_CONNECTION=sqlite
# O si usas MySQL:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=rentify
# DB_USERNAME=root
# DB_PASSWORD=
```

### Paso 4: Ejecutar Migraciones y Seeders

```bash
# Crear tablas en la base de datos
php artisan migrate

# Poblar con datos de ejemplo
php artisan db:seed
```

### Paso 5: Compilar Assets

```bash
# Compilar archivos CSS y JavaScript
npm run build

# O para desarrollo con auto-compilación:
npm run dev
```

### Paso 6: Iniciar el Servidor

```bash
php artisan serve
```

La aplicación estará disponible en: `http://localhost:8000`

## 📋 Credenciales de Acceso

Después de ejecutar los seeders, puedes acceder con:

**Administrador:**
- Email: `admin@rentify.com`
- Contraseña: `password`

**Usuario Colaborador:**
- Email: `user@rentify.com`
- Contraseña: `password`

## 📱 Estructura del Proyecto

```
Rentify/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── PropertyController.php
│   │   │   ├── TenantController.php
│   │   │   ├── ReservationController.php
│   │   │   ├── TransactionController.php
│   │   │   └── DashboardController.php
│   │   ├── Middleware/
│   │   │   └── CheckRole.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Role.php
│   │   ├── Property.php
│   │   ├── Tenant.php
│   │   ├── Reservation.php
│   │   └── Transaction.php
├── database/
│   ├── migrations/
│   ├── seeders/
│   │   ├── RoleSeeder.php
│   │   ├── UserSeeder.php
│   │   ├── TenantSeeder.php
│   │   ├── PropertySeeder.php
│   │   └── TransactionSeeder.php
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   ├── app.blade.php
│   │   │   ├── sidebar.blade.php
│   │   │   └── navbar.blade.php
│   │   ├── dashboard.blade.php
│   │   ├── properties/
│   │   ├── tenants/
│   │   ├── reservations/
│   │   └── transactions/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   │   ├── app.js
│   │   └── bootstrap.js
├── routes/
│   ├── web.php
│   └── auth.php
└── public/
    └── storage/
```

## 🗄️ Modelos y Relaciones

### User
- `hasMany Role`
- Métodos: `hasRole()`, `isAdmin()`, `isUser()`

### Property
- `belongsTo Tenant`
- `hasMany Reservation`
- `hasMany Transaction`

### Tenant
- `hasMany Property`
- `hasMany Reservation`

### Reservation
- `belongsTo Property`
- `belongsTo Tenant`

### Transaction
- `belongsTo Property`

### Role
- `hasMany User`

## 🎨 Tecnologías Utilizadas

- **Backend**: Laravel 12
- **Frontend**: Blade Templates
- **Estilos**: TailwindCSS
- **Gráficas**: Chart.js
- **Autenticación**: Laravel Breeze
- **Base de Datos**: SQLite/MySQL
- **Build Tool**: Vite

## 📊 Dashboard

El dashboard incluye:
- Tarjetas de estadísticas (Total de propiedades, disponibles, ocupadas, inquilinos)
- Estadísticas financieras (Ingresos, gastos, balance)
- Gráfica de ingresos mensuales
- Gráfica de estado de propiedades
- Transacciones recientes
- Próximas reservas

## 🔐 Control de Acceso

- **Admin**: Acceso completo a todas las funciones
- **Colaborador**: Acceso limitado según permisos
- Middleware de roles para proteger rutas

## 📝 Usar la Aplicación

### Gestión de Propiedades
1. Ve a **Propiedades** en la barra lateral
2. Haz clic en **Nueva Propiedad**
3. Completa el formulario con los datos de la propiedad
4. Opcionalmente sube una imagen
5. Guarda la propiedad

### Gestión de Inquilinos
1. Ve a **Inquilinos** en la barra lateral
2. Haz clic en **Nuevo Inquilino**
3. Ingresa los datos de contacto del inquilino
4. Agrega notas si es necesario

### Crear Reservas
1. Ve a **Reservas** en la barra lateral
2. Haz clic en **Nueva Reserva**
3. Selecciona propiedad e inquilino
4. Define las fechas de inicio y fin
5. Ingresa el precio total

### Registrar Transacciones
1. Ve a **Transacciones** en la barra lateral
2. Haz clic en **Nueva Transacción**
3. Selecciona la propiedad
4. Elige si es ingreso o gasto
5. Ingresa monto, concepto y fecha

## 🛠️ Comandos Útiles

```bash
# Generar nueva migración
php artisan make:migration create_table_name

# Generar nuevo modelo
php artisan make:model ModelName

# Generar nuevo controller
php artisan make:controller ControllerName --resource

# Ejecutar seeders específicos
php artisan db:seed --class=RoleSeeder

# Limpiar caché
php artisan cache:clear

# Regenerar autoload de Composer
composer dump-autoload
```

## 📱 Vistas Disponibles

- **Dashboard**: Panel de control con estadísticas
- **Propiedades**: Listado, crear, editar, ver detalles
- **Inquilinos**: Listado, crear, editar, ver detalles
- **Reservas**: Listado, crear, editar, ver detalles
- **Transacciones**: Listado, crear, editar, ver detalles

## 🐛 Solución de Problemas

### Error: "Class not found"
```bash
composer dump-autoload
```

### Error en migraciones
```bash
# Reset de base de datos
php artisan migrate:reset

# Volver a ejecutar migraciones
php artisan migrate --seed
```

### Assets no compilan
```bash
# Limpiar caché de Node
rm -rf node_modules
npm install
npm run build
```

## 📄 Licencia

Este proyecto está bajo la licencia MIT.

## 👨‍💻 Autor

Desarrollado como un proyecto de portfolio moderno para la gestión de alquileres.

## 🤝 Contribuciones

Las contribuciones son bienvenidas. Por favor abre un issue o pull request para cambios mayores.

---

**Nota**: Este es un proyecto base completamente funcional listo para ser expandido con más características según tus necesidades.
