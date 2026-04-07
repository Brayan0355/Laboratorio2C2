
**Usuario y contraseña a utilizar en el login:** 
*   Usuario: admin
*   Contraseña: password123


**1. ¿De qué forma manejaste el login de usuarios? Explica con tus palabras porque en tu página funciona de esa forma.**

El login valida que el usuario y su contraseña (cifrada por seguridad) existan en la base de datos a través de una consulta preparada para evitar hackeos. Funciona usando Sesiones (`$_SESSION`) de PHP: una vez validado, se guarda el ID del usuario en una variable de sesión temporal. Esto permite que el servidor "recuerde" de forma segura qué usuario está navegando entre las diferentes páginas, sin tener que pedirle la contraseña nuevamente a cada clic.


**2. ¿Por qué es necesario para las aplicaciones web utilizar bases de datos en lugar de variables?**

Porque toda la información guardada en variables de PHP desaparece de la memoria en cuanto finaliza de cargar el sitio en el navegador. En cambio, las bases de datos guardan la información en el disco duro del servidor de forma **permanente** y organizada, lo que permite guardar usuarios, recuperar registros antiguos y no perder nada al recargar la página.


**3. ¿En qué casos sería mejor utilizar bases de datos para su solución y en cuáles utilizar otro tipo de datos temporales como cookies o sesiones?**

*   **Bases de Datos:** Se usan siempre para datos **permanentes e indispensables** (ej: credenciales, lista de productos, reportes financieros).
*   **Sesiones:** Se usan para datos **temporales de seguridad** y que duran solo lo que el usuario está en la página (ej: mantener iniciada la sesión o permisos del área administrativa temporal).
*   **Cookies:** Se usan para guardar **preferencias inofensivas** directo en el navegador de la computadora del usuario (ej: guardar si le gusta el tema claro/oscuro, guardar los artículos del carrito de compras).

<br>

**4. Describa brevemente sus tablas y los tipos de datos utilizados en cada campo; justifique la elección del tipo de dato para cada uno**

**Tabla Usuarios** (Utilizada para el control de acceso de la seguridad):
*   **Identificador:** Utilizamos números enteros (que crecen secuencialmente) porque todo usuario necesita de un número de ID único para ser encontrado rápidamente.
*   **Nombre de usuario:** Utilizamos texto de longitud moderada-corta, ideal para ahorrar espacio porque se pide que digiten un "username" sin grandes oraciones.
*   **Contraseña:** Utilizamos texto de gran longitud. Esta medida no es por si alguien pone una clave gigante, sino que es obligatoria para poder almacenar los resultados "encriptados" o cifrados que el sistema genera por debajo para mantener todo ultra seguro.

**Tabla Productos** (Guarda los registros que vemos en el panel):
*   **Identificador:** De manera similar a los usuarios, le asignamos datos puramente numéricos y enteros para asignarle un código que nunca cambie a cada fila.
*   **Nombre:** Se planteó de manera textual con tamaño definido. Su longitud limitada es la mejor opción previendo que nombres demasiado largos puedan romper las columnas del sitio web.
*   **Descripción:** A diferencia del nombre, aquí se justificó aplicar el tipo texto "abierto" o gigante, el mejor para campos donde puedes escribir cosas aleatorias como especificaciones y muchísimos renglones extra sin preocuparte que se corte a la mitad.
*   **Precio:** El justificante principal acá es usar un tipo de dato numérico que cuente con formato "decimal" exacto de dos dígitos. Esto es lo fundamental si manejas dinero para que los impuestos o céntimos no comiencen a generar promedios raros de error.
*   **Creado en:** Se diseñó con un formato de tipo de "fecha automatizada en el servidor". Esto se eligió para no estar pidiendo a la gente que escriba qué día metieron cada registro, la base de datos mapea la fecha sola con su propia hora del reloj.


