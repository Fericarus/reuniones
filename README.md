README:::

# Proyecto Reuniones

Este proyecto contiene:

- **Frontend (Angular):** carpeta `reuniones-frontend`
- **Backend (Laravel):** carpeta `reuniones-api`

## Cómo usar

### Backend (Laravel)
1. Entrar a `reuniones-api`
2. Ejecutar `composer install`
3. Configurar `.env`
4. Ejecutar `php artisan migrate` y `php artisan serve`

### Frontend (Angular)
1. Entrar a `reuniones-frontend`
2. Ejecutar `npm install`
3. Ejecutar `ng serve`


:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
Cuestionario PHP Senior – Teoría y Práctica

¿Cuál fragmento cumple con los principios de inmutabilidad?

1. A)
   $this->monto += 100;
   return $this;
   B)
   $new = clone $this;
   $new->monto += 100;
   return $new;
   C)
   return $this->monto += 100;
   D)
   php
   CopyEdit
   $this->setMon

Respuesta: B

En todas las demás opciones se está alterando al objeto $this directamente. Solo al hacer clone this y almecenarlo en otra nueva variable como por ejemplo newObject se crea una copia del objeto original. Al realizar cambios sobre newObject los datos de this se mantienen intactos.


2. ¿Qué hace declare(strict_types=1)?
   A) Ignora conversiones
   B) Error de compilación
   C) Fuerza tipos estrictos
   D) Impide clases dinámicas

Respuesta: C

Al establecer que nuestro archivo de php maneje estrictamente los tipos evitamos que las funciones que declaremos no puedan cambiar ciertos valores por otros diferentes. Por ejemplo, si una función recibe "2" en formato string PHP puede llegar a transformar ese valor en un dato de tipo entero 2 lo que generaría un comportamiento diferente al esperado en nuestras funciones


3. ¿Qué es cierto del Garbage Collector en PHP?
   A) Destruye inmediato
   B) Basado en conteo de referencias
   C) Eliminado en PHP 7
   D) Referencias circulares no afectan

Respuesta: B

Entieno que al asignar valores a variables esto genera una referencia. Esta al llegar a ceros el Garbage Collector libera ese espacio de memoria. La verdad si tengo dudas con este punto todavía.


4. ¿Qué patrón encapsula algoritmos intercambiables?
   A) Singleton
   B) Strategy
   C) Builder
   D) Facade

Respuesta: Strategy

Este patrón define un grupo o familia de algoritmos para poder realizar una tarea de diferentes formas. Por ejemplo:

interface OrdenamientoStrategy {
    public function ordenar(array $datos): array;
}

class OrdenarAscendente implements OrdenamientoStrategy {
    public function ordenar(array $datos): array {
        sort($datos);
        return $datos;
    }
}

class OrdenarDescendente implements OrdenamientoStrategy {
    public function ordenar(array $datos): array {
        rsort($datos);
        return $datos;
    }
}

Los dos métodos del final "sobreescriben" el método ordenar lo que nos permite poder diferentes comportamientos de una misma función.


5. ¿Qué hace array_merge() con claves numéricas?
   A) Sobrescribe
   B) Conserva claves
   C) Reindexa
   D) Arroja error

Respuesta: C

Si los arrays en PHP no tienen claves númericas explicitas, PHP asigna un valor a cada valor del arreglo comezando desde cero. Al "fusionar" ambos arreglos vuelve a hacer la reasignación de ambos arreglos en uno solo comenzando nuevamente desde cero.

En el caso de que la clave no sea númerica sino un string por ejemplo, PHP lo que hará al hacer merge es  que si encuentra una valor repetido lo sobreescribirá.


¿Cual es el patron de diseño Singleton y cuando es recomendableusarlo?

Respuesta: Este patrón se utiliza cuando se requiere que una clase tenga una sola instanci. Un ejemplo es cuando realizamos una conexión a la BD o tenemos  configuraciones globales (como variables de entorno)


¿Que es la inyeccion de dependencias? Da un ejemplo.

Respuesta: Similar a lo que se hace en React, las dependencias son parametros u objetos que le podemos pasar a una clase externa para evitar que se tenga que crear desde cero al iniciar la clase. Ejemplo:

class Logger {

    public function log(string $mensaje) {
        echo "Log: $mensaje\n";
    }
}

class UsuarioService {
    private Logger $logger;

    public function __construct(Logger $logger) {$this->logger = $logger;
    }

    public function crearUsuario() {
        $this->logger->log("Usuario creado");
    }
}

// Inyectamos la dependencia desde fuera
$logger = new Logger();
$service = new UsuarioService($logger);
$service->crearUsuario();


¿En consultas a base de datos relacionales que diferencia hay entre LEFT JOIN y INNER JOIN?.

Inner Join Solo trae los registros que tienen coincidencia en ambas tablas

Left Join Trae  **todos los registros de la tabla izquierda** , aunque no coincidan


¿Cómo resolverías una dependencia circular entre clases A y B en PHP? ¿Qué patrón aplicarías?

De esta no tengo muy claro como resolverlo. Lo que se me ocurre es detectar patrones y extraer fuera de las clases los valores



¿Cuál es la diferencia entre hasOne y belongsTo en Eloquent? ¿En qué casos usarías cada uno?

HasOne verifica que un objeto tenga una propiedad u objeto y belongs es si esa clase pertenece a oyra clase. Por ejemplo, si un usuario tiene un perfil se utilizaría hasOne y para validar que un perfil pertenexca a un usuario se utilizaría belongs


¿Qué hace el método with() en Eloquent y cómo mejora el rendimiento de las consultas?

Nunca lo he utilizado. Lo que he investigado es que mejora el rendimiento de una consulta evitando el problema de que la la complejidad de la consulta escale exponencialmente.


¿Cómo funciona el Service Container de Laravel y qué ventajas ofrece al usar inyección de dependencias?

Es un contenedor de dependencias que Laravel utiliza para construir objetos automaticamente. Al termianr este proceso se entrega una instancia ya construida con todo lo necesario. Las ventajas que ofrece es un código desacoplado y facilitar las pruebas.


¿Qué diferencias hay entre middleware global, route middleware y group middleware? Da un ejemplo de cada uno.

Global se aplica a todas las rutas, Route a una ruta especifica y grupo a un grupo de rutas

// Global

protected $middleware = [
    \App\Http\Middleware\VerificarMantenimiento::class,
];

// Route
Route::get('/admin', 'AdminController@index')->middleware('auth');

// Group
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', 'DashboardController@index');
});


¿Qué son los Observables y cómo se diferencian de las Promises en Angular?

Las propises son eventos asincrónicos que tienen un ciclo de vida "corto", es decir, cuando la promesa se cumple se entrega el then, el catch o el finally y se termina. Los observable se quedan activos por mucho más tiempo. De cierta manera es similar a un socket que está activo hasta que se cierra deliberadamente.


Explica el ciclo de vida de un componente Angular. ¿Qué métodos se llaman y en qué orden?

Estos son:

constructor()  ->  ngOnChanges() (similar al useEffect)  ->  ngDoCheck() (Cuando hay cambios manuales)  ->  ngOnDestroy()


¿Qué es un interceptor en Angular y cómo se implementa? Da un caso de uso práctico.

Permite interceptar **todas las peticiones y respuestas HTTP** globalmente.