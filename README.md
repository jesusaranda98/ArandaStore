# 🎮 ArandaStore - Tienda de Videojuegos Online

Sistema e-commerce desarrollado con **Laravel**, **Tailwind CSS** y **MySQL** para la gestión integral de catálogo, clientes, inventario y ventas en tiempo real.

## 🚀 Características y Reglas de Negocio

- **Clientes:**
  - Registro de nombre completo, teléfono, correo electrónico y dirección.
  - Validación de unicidad: no se permiten números de teléfono ni correos duplicados.
  - Restricción de integridad: no se pueden eliminar clientes con historial de compras.

- **Catálogo & Videojuegos:**
  - Filtrado interactivo por categorías (Terror, Ciencia Ficción, Acción, Battle Royale).
  - Consulta de sinopsis, precio, carátula e inventario en tiempo real.
  - Validación de unicidad: no se permiten videojuegos con nombres duplicados.
  - Restricción de integridad: no se pueden eliminar videojuegos con ventas asociadas.

- **Módulo de Ventas & Stock:**
  - Validación de fecha: restricción estricta contra fechas pasadas.
  - Descuento de stock en tiempo real al concretar una compra.
  - Cancelación de compras con reintegro automático de unidades al catálogo.
  - Historial general de órdenes y estado de transacciones.

## 🛠️ Tecnologías

- **Framework:** Laravel
- **Base de Datos:** MySQL (vía XAMPP / phpMyAdmin)
- **Frontend:** Blade, Tailwind CSS & Bootstrap Icons