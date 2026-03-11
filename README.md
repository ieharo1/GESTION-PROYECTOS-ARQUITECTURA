# 🏗️ Gestión de Proyectos de Arquitectura

Sistema completo para la gestión de proyectos de arquitectura.

---

## 📝 Descripción

Plataforma profesional para la administración de proyectos arquitectónicos. Gestiona clientes, proyectos, planos, presupuestos, materiales y etapas de obra.

### ¿Qué hace este proyecto?

- **Gestión de Clientes**: Registro de clientes
- **Gestión de Proyectos**: Control de proyectos arquitectónicos
- **Planos**: Subida y gestión de planos
- **Presupuestos**: Elaboración de presupuestos
- **Materiales**: Control de materiales
- **Etapas de Obra**: Seguimiento (diseño, aprobación, construcción, finalización)
- **Dashboard**: Proyectos activos, presupuesto total, avance de obras

---

## ✨ Características Principales

| Característica | Descripción |
|----------------|-------------|
| 👥 **Gestión de Clientes** | Registro de clientes |
| 🏗️ **Proyectos** | Control de proyectos |
| 📐 **Planos** | Subida de planos |
| 💰 **Presupuestos** | Elaboración de presupuestos |
| 🧱 **Materiales** | Control de materiales |
| 📋 **Etapas** | Diseño, aprobación, construcción |
| 📊 **Dashboard** | Proyectos activos, presupuesto |

---

## 🛠️ Stack Tecnológico

- **Backend**: PHP 8.3, Laravel 11, Livewire 3
- **Frontend**: HTML5, CSS3, Bootstrap 5, JavaScript Vanilla
- **Base de datos**: MySQL/MariaDB

---

## 🚀 Instalación y Uso

### Requisitos

- PHP 8.2+
- Composer
- MySQL/MariaDB

### Instalación

```bash
# Clonar el repositorio
git clone <repositorio>

# Instalar dependencias
composer install

# Copiar archivo de entorno
cp .env.example .env

# Generar clave de aplicación
php artisan key:generate

# Ejecutar migraciones
php artisan migrate

# Poblar base de datos con datos de ejemplo
php artisan db:seed

# Iniciar servidor
php artisan serve
```

### Usar Docker

```bash
# Construir y levantar contenedores
docker compose up -d --build

# Ver estado de los contenedores
docker compose ps

# Acceder al contenedor
docker compose exec app bash

# Ejecutar migraciones dentro del contenedor
php artisan migrate

# Poblar base de datos
php artisan db:seed

# Ver logs
docker compose logs -f app
```

### Credenciales por defecto

| Rol | Email | Contraseña |
|-----|-------|------------|
| Administrador | admin@arquitectura.com | password |

---

## 📁 Estructura del Proyecto

```
├── app/
│   ├── Livewire/           # Componentes Livewire
│   ├── Models/             # Modelos Eloquent
├── database/
│   ├── migrations/         # Migraciones
│   ├── seeders/            # Seeders
├── resources/views/        # Vistas Blade
├── docker-compose.yml      # Docker
└── Dockerfile              # Configuración Docker
```

---

## 📊 Módulos del Sistema

1. **Dashboard**: Proyectos activos, presupuesto total, avance
2. **Clientes**: CRUD de clientes
3. **Proyectos**: Control de proyectos arquitectónicos
4. **Planos**: Subida y gestión
5. **Presupuestos**: Elaboración
6. **Materiales**: Control
7. **Etapas**: Diseño, aprobación, construcción, finalización

---

## ⚠️ Requisitos del Sistema

- PHP 8.2 o superior
- Composer
- MySQL 8.0 o MariaDB

---

## 📦 Paquetes Utilizados

- `laravel/framework` - Framework Laravel
- `livewire/livewire` - Componentes reactivos
- `bootstrap` - Framework CSS

---

## 👨‍💻 Desarrollado por Isaac Esteban Haro Torres

**Ingeniero en Sistemas · Full Stack · Automatización · Data**

- 📧 Email: zackharo1@gmail.com
- 📱 WhatsApp: 098805517
- 💻 GitHub: https://github.com/ieharo1
- 🌐 Portafolio: https://ieharo1.github.io/portafolio-isaac.haro/

---

© 2026 Isaac Esteban Haro Torres - Todos los derechos reservados.
