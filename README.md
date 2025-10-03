
# 🏨 Hotel Viña del Sur — Sistema de Gestión de Reservas

Sistema web académico para la administración de reservas, estancias y servicios del *Hotel Viña del Sur* (Tarija).  
Desarrollado en **CodeIgniter 4**, **PHP 8.2**, **MariaDB 10.4**.

---

## 📦 Requisitos previos
- XAMPP con Apache (puerto 80 y 443) y MySQL/MariaDB (puerto 3306).
- PHP 8.2 (incluido en XAMPP actualizado).
- phpMyAdmin (incluido en XAMPP).
- Composer instalado en el sistema.

---

## Link de descarga
- Xampp: https://www.apachefriends.org/es/download.html
- CodeIgniter4: https://www.codeigniter.com/download/

---

## 🛠️ Instalación paso a paso (XAMPP)

1. **Ubicación del proyecto**  
   Copia la carpeta del proyecto en:
```

C:\xampp\htdocs\hotel

```
Acceso en navegador:  
```

[http://localhost/hotel/](http://localhost/hotel/)

````

2. **Iniciar servicios**  
- Abre XAMPP Control Panel.  
- Inicia **Apache** y **MySQL**.

3. **Configurar base de datos**  
- Accede a phpMyAdmin:  
  ```
  http://localhost/phpmyadmin/
  ```
- Crea una base de datos llamada:
  ```
  hotel_db
  ```
- Importa el archivo `.sql` que está en la carpeta `/database/` del proyecto (lo encontrarás dentro del repositorio).

4. **Configurar variables de entorno**  
- Copia `.env.example` → `.env`  
- Edita los parámetros de conexión:
  ```env
  app.baseURL = 'http://localhost/hotel/'
  database.default.hostname = 127.0.0.1
  database.default.database = hotel_db
  database.default.username = root
  database.default.password =
  database.default.DBDriver = MySQLi
  ```

5. **Instalar dependencias (Composer)**  
Abre la terminal en la carpeta del proyecto y ejecuta:
```bash
composer install
````

6. **Acceder al sistema**

   * Página principal:

     ```
     http://localhost/hotel/
     ```

---

## 🔐 Credenciales de acceso por defecto

* **Usuario:** `Admin`
* **Contraseña:** `Password`

⚠️ Estas credenciales ya se encuentran registradas en la **base de datos inicial** que se importa desde el archivo `.sql`.

---

## ✅ Checklist de verificación rápida

* [ ] Apache y MySQL corren en XAMPP.
* [ ] Base de datos `hotel_db` creada e importada.
* [ ] Acceso a `http://localhost/hotel/`.
* [ ] Inicio de sesión con `Admin / Password`.

---

## 📌 Notas finales

* Este proyecto fue desarrollado con fines académicos en el marco del diplomado en Ingeniería de Sistemas.
* Asegúrarse de tener los servicios de XAMPP encendidos antes de acceder al sistema.
