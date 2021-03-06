<?php

return [
    'coverages' => [
        [
            'name' => 'Individual',
            'slug' => 'IC'
        ],
        [
            'name' => 'Mancomunado',
            'slug' => 'MC'
        ],
        [
            'name' => 'Banca Comunal',
            'slug' => 'BC'
        ],
    ],

    'user_types' => [
        'ADT' => 'Administrador',
        'UST' => 'Usuario',
        'OPT' => 'Operador',
    ],

    'client_types' => [
        'N' => 'Natural',
        'L' => 'Jurídico',
    ],

    'client_document_types' => [
        'CI'  => 'Carnet de Identidad',
        'PE'  => 'Persona Extranjera',
        'PA'  => 'Pasaporte',
        'RUN' => 'Registro Único Nacional',
    ],

    'client_civil_status' => [
        'S' => 'Soltero(a)',
        'C' => 'Casado(a)',
        'D' => 'Divorciado(a)',
        'V' => 'Viudo(a)',
        'F' => 'Unión Libre',
    ],

    'client_genders' => [
        'M' => 'Masculino',
        'F' => 'Femenino',
    ],

    'client_hands' => [
        'R' => 'Derecha',
        'L' => 'Izquierda',
    ],

    'product_types' => [
        'PH' => 'Ramo Humano',
        'PG' => 'Ramo General',
    ],

    'retailer_product_types' => [
        'MP' => 'Producto Principal',
        'SP' => 'Sub Producto',
        'RP' => 'Producto Alternativo',
    ],

    'currencies' => [
        'BS'  => 'Bolivianos',
        'USD' => 'Dolares',
    ],

    'product_parameters' => [
        'GE' => 'General',
        'FC' => 'Free Cover',
        'AE' => 'Afiliación Automática',
        'FA' => 'Facultativo',
    ],

    'header_types' => [
        'Q' => 'Cotización',
        'I' => 'Emisión',
    ],

    'term_types' => [
        'Y' => 'Años',
        'M' => 'Meses',
        'W' => 'Semanas',
        'D' => 'Días',
    ],

    'headlines' => [
        'D' => 'Deudor',
        'C' => 'Codeudor',
    ],

    'beneficiary_coverages' => [
        'AP' => 'Accidentes Personales',
        'VI' => 'Vida en Grupo',
        'SP' => 'Sepelio',
        'CO' => 'Vida en Grupo Contingente',
    ],

    'facultative_states' => [
        'PR' => 'Procesado',
        'PE' => 'Pendiente',
    ],

    'avenue_street' => [
        'A' => 'Avenida',
        'S' => 'Calle',
    ],

    'payment_methods' => [
        'CO' => 'Al Contado',
        'DA' => 'Débito Automático',
        'PT' => 'Prima Total',
        'AN' => 'Anualizado',
    ],

    'account_types' => [
        'CA' => 'Cuenta Corriente',
        'SA' => 'Caja de Ahorro',
    ],

    'account_number_types' => [
        'DC' => 'Tarjeta de Débito',
        'CC' => 'Tarjeta de Crédito',
        'AC' => 'Cuenta',
    ],

    'periods' => [
        'Y' => 'Anual',
        'M' => 'Mensual'
    ],

    'profiles' => [
        'SUP' => 'Supervisor',   // Reportes - Emision
        'REP' => 'Reportes',     // Nacional - Sucursal - Agencia
        'SEP' => 'Vendedor',     // Cotizacion - Emision - Reportes
        'COP' => 'Compañia',     // Procesar casos - Rep. Producto
        'TEP' => 'Pruebas',      // Supervisor
    ],

    'states' => [
        'cl' => 'Aclaraciones',
        'me' => 'Exámenes Médicos y/o Requisitos',
        'de' => 'Error en Datos',
        're' => 'Reaseguro',
        'in' => 'Inspección',
        'sm' => 'Medidas de Seguridad',
    ],

    'company_state' => [
        'A' => 'Aprobado',
        'R' => 'Rechazado',
        'P' => 'Pendiente',
        'O' => 'Observado',
        'C' => 'Subsanado/Pendiente',
    ],

    'company_state_icon' => [
        'A' => 'glyphicon-ok',
        'R' => 'glyphicon-remove',
        'P' => 'glyphicon-time',
        'O' => 'glyphicon-repeat',
        'C' => 'glyphicon-refresh',
    ],

    'medical_certificate_types' => [
        'E' => 'Editor',
        'C' => 'Cuestionario',
    ],

    'mc_question_types' => [
        'CB' => 'Checkbox',
        'RB' => 'Radio Button',
        'TX' => 'Texto',
        'TA' => 'Area Texto',
    ],

    'module_class' => [
        0 => 'col-md-4',
        1 => 'col-md-12',
        2 => 'col-md-6',
    ],

    'permissions' => [
        'RN'  => 'Reporte Nacional',
        'RR'  => 'Reporte Sucursal/Regional',
        'RA'  => 'Reporte Agencia',
        'RU'  => 'Reporte Usuario',
        'APL' => 'Administración de Polizas',
        'ACV' => 'Administración de Coberturas',
        'ART' => 'Administración de Tasas',
        'AOC' => 'Administración de Ocupaciones',
        'AQS' => 'Administración de Preguntas',
        'AMC' => 'Administración de Certificado Médico',
        'AER' => 'Administración de Tipo de Cambio',
        'AST' => 'Administración de Estados',
        'AFR' => 'Administración de Formularios',
        'AEM' => 'Administración de Correos Electronicos',
        'ACA' => 'Administración de Departamento/Agencia',
        'AUS' => 'Administración de Usuarios',
        'ADE' => 'Administración de Desgravamen',
        'AVI' => 'Administración de Vida',
        'AAU' => 'Administración de Automotores',
    ],

    'inbox' => [ 'all', 'approved', 'observed', 'rejected', ],

    'vehicle_category' => [
        'CA' => 'A',
        'CB' => 'B',
        'RC' => 'Rent A Car',
        'OT' => 'Otros',
    ],

    'vehicle_use' => [
        'PU' => 'Público',
        'PR' => 'Privado',
    ],

    'property_types' => [
        'PR' => 'Inmueble',
        'EE' => 'Equipo Electrónico',
        'MC' => 'Maquinaria',
        'ME' => 'Equipo Móvil',
    ],

    'property_uses' => [
        'ID' => 'Inmueble Domiciliario',
        'IP' => 'Inmueble Industrial',
        'OT' => 'Otro',
    ],

    'property_states' => [
        'F' => 'Terminado',
        'C' => 'En construcción',
        'P' => 'En proceso de remodelación, ampliación o refacción',
    ],

    'sp_modalities' => [
        'MS' => 'Modalidad Valor Estático',
        'MV' => 'Modalidad Valor Asegurado',
    ],

    'credit_products' => [
        'PCS' => 'Consumo',
        'PCM' => 'Comercial',
        'PMO' => 'Hipotecario',
        'PCA' => 'Tarjetas',
        'POT' => 'Otros',
    ],

    'movement_types' => [
        'FS' => 'Primera/Única',
        'AD' => 'Adicional',
        'LC' => 'Línea de Crédito',
    ],

    'question_types' => [
        'PMO' => 'Hipotecario',
    ],

    'policy_types' => [
        'DE' => 'Desgravamen',
        'VI' => 'Vida Grupo',
    ],

];