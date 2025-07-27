{{-- resources/lang/es/validation.php --}}
<?php
return [
    'min' => [
        'numeric' => 'El campo :attribute debe ser al menos :min.',
        'file' => 'El archivo :attribute debe tener al menos :min kilobytes.',
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
    ],
    'max' => [
        'string' => 'El campo :attribute no puede tener más de :max caracteres.',
        'numeric' => 'El campo :attribute no puede ser mayor de :max.',
        'file' => 'El archivo :attribute no debe pesar mas de :min kilobytes.',
    ],
    'required' => 'El campo :attribute es obligatorio.',
    'nullable' => 'El campo :attribute es opcional.',
    'exists' => 'El :attribute seleccionado no es válido.',
    'string' => 'El campo :attribute debe ser una cadena de texto.',
    'integer' => 'El campo :attribute debe ser un número entero.',
    'confirmation' => 'El campo :attribute no coincide.',
    'confirmed' => 'El campo :attribute no coincide.',

    'attributes' => [
        'nombre_examen' => 'Nombre del examen',
        'descripcion_examen' => 'Descripción',
        'duracion_examen' => 'Duración',
        'tema_id' => 'Tema',
        'password' => 'Contraseña',
        'rol_usuario' => 'Rol',
        'puesto_usuario' => 'Puesto',
        'estatus' => 'Estado',
        'fecha_ingreso' => 'Fecha de Ingreso',
    ],
];