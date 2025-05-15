<?php

return [
  'webpay_plus_status' =>
  [
    [
      'field' => 'vci',
      'value' => [
        'visita este link para ver la informacion detallada de este campo https://www.transbankdevelopers.cl/producto/webpay#vci',
      ],
    ],
    [
      'field' => 'amount',
      'value' => 'Formato número entero para transacciones en peso y decimal para transacciones en dólares. Largo máximo: 17',
    ],
    [
      'field' => 'status',
      'value' => 'Estado de la transacción (INITIALIZED, AUTHORIZED, REVERSED, FAILED, NULLIFIED, PARTIALLY_NULLIFIED, CAPTURED). Largo máximo: 64',
    ],
    [
      'field' => 'buy_order',
      'value' => 'Orden de compra de la tienda indicado en Transaction.create(). Largo máximo: 26',
    ],
    [
      'field' => 'session_id',
      'value' => 'Identificador de sesión, el mismo enviado originalmente por el comercio en Transaction.create(). Largo máximo: 61.',
    ],
    [
      'field' => 'card_detail',
      'value' => 'Objeto que representa los datos de la tarjeta de crédito del tarjeta habiente.',
    ],
    [
      'field' => 'card_detail.card_number',
      'value' => '4 últimos números de la tarjeta de crédito del tarjetahabiente. Largo máximo: 19.',
    ],
    [
      'field' => 'accounting_date',
      'value' => 'Fecha de la autorización. Largo: 4, formato MMDD',
    ],
    [
      'field' => 'transaction_date',
      'value' => 'Fecha y hora de la autorización. Largo: 24, formato: ISO 8601 (Ej: yyyy-mm-ddTHH:mm:ss.xxxZ)',
    ],
    [
      'field' => 'authorization_code',
      'value' => 'Código de autorización de la transacción. Largo máximo: 6',
    ],
    [
      'field' => 'payment_type_code',
      'value' => [
        'Tipo de pago de la transaccion.',
        'VD = Venta Débito.',
        'VP = Venta prepago',
        'VN = Venta Normal.',
        'VC = Venta en cuotas.',
        'SI = 3 cuotas sin interés.',
        'S2 = 2 cuotas sin interés.',
        'NC = N Cuotas sin interés',
      ],
    ],
    [
      'field' => 'response_code',
      'value' => 'Código de respuesta de la autorización.',
    ],
    [
      'field' => 'installments_amount',
      'value' => 'Monto de las cuotas. Largo máximo: 17',
    ],
    [
      'field' => 'installments_number',
      'value' => 'Cantidad de cuotas. Largo máximo: 2',
    ],
    [
      'field' => 'balance',
      'value' => 'Monto restante para un detalle anulado. Largo máximo: 17',
    ],
  ],
  'webpay_plus_refund' =>
  [
    [
      'field' => 'type',
      'value' => 'Tipo de reembolso (REVERSED o NULLIFIED). Si es REVERSED no se devolverán datos de la transacción (authorization code, etc). Largo máximo: 10',
    ],
    [
      'field' => 'authorization_code',
      'value' => '(Solo si es NULLIFIED) Código de autorización de la anulación. Largo máximo: 6',
    ],
    [
      'field' => 'authorization_date',
      'value' => '(Solo si es NULLIFIED) Fecha y hora de la autorización.',
    ],
    [
      'field' => 'balance',
      'value' => '(Solo si es NULLIFIED) Saldo actualizado de la transacción (considera la venta menos el monto anulado). Largo máximo: 17',
    ],
    [
      'field' => 'nullified_amount',
      'value' => '(Solo si es NULLIFIED) Monto anulado. Largo máximo: 17',
    ],
    [
      'field' => 'response_code',
      'value' => '(Solo si es NULLIFIED) Código de resultado de la reversa/anulación. Si es exitoso es 0, de lo contrario la reversa/anulación no fue realizada Largo Máximo: 2',
    ],
  ],
  'webpay_plus_mall_status' =>
  [
    [
      'field' => 'buy_order',
      'value' => 'Orden de compra de la tienda indicado en Transaction.create(). Largo máximo: 26',
    ],
    [
      'field' => 'session_id',
      'value' => 'Identificador de sesión, el mismo enviado originalmente por el comercio en Transaction.create(). Largo máximo: 61.',
    ],
    [
      'field' => 'card_detail',
      'value' => 'Objeto que representa los datos de la tarjeta de crédito del tarjeta habiente.',
    ],
    [
      'field' => 'card_detail.card_number',
      'value' => '4 últimos números de la tarjeta de crédito del tarjetahabiente. Largo máximo: 19.',
    ],
    [
      'field' => 'accounting_date',
      'value' => 'Fecha de la autorización. Largo: 4, formato MMDD',
    ],
    [
      'field' => 'transaction_date',
      'value' => 'Fecha y hora de la autorización. Largo: 24, formato: ISO 8601 (Ej: yyyy-mm-ddTHH:mm:ss.xxxZ)',
    ],
    [
      'field' => 'vci',
      'value' => [
        'visita este link para ver la informacion detallada de este campo https://www.transbankdevelopers.cl/producto/webpay#vci',
      ],
    ],
    [
      'field' => 'details',
      'value' => 'Lista con resultado de cada una de las transacciones enviados en Transaction.create().',
    ],
    [
      'field' => 'details[].authorization_code',
      'value' => 'Código de autorización de la transacción. Largo máximo: 6',
    ],
    [
      'field' => 'details[].payment_type_code',
      'value' => [
        'Tipo de pago de la transaccion.',
        'VD = Venta Débito.',
        'VP = Venta prepago',
        'VN = Venta Normal.',
        'VC = Venta en cuotas.',
        'SI = 3 cuotas sin interés.',
        'S2 = 2 cuotas sin interés.',
        'NC = N Cuotas sin interés',
      ],
    ],
    [
      'field' => 'details[].response_code',
      'value' => 'Código de respuesta de la autorización.',
    ],
    [
      'field' => 'details[].amount',
      'value' => 'Formato número entero para transacciones en peso y decimal para transacciones en dólares. Largo máximo: 10',
    ],
    [
      'field' => 'details[].installments_amount',
      'value' => 'Monto de las cuotas. Largo máximo: 17',
    ],
    [
      'field' => 'details[].installments_number',
      'value' => 'Cantidad de cuotas. Largo máximo: 2',
    ],
    [
      'field' => 'details[].commerce_code',
      'value' => 'Código comercio de la tienda. Largo: 12',
    ],
    [
      'field' => 'details[].buy_order',
      'value' => 'Orden de compra de la tienda. Largo máximo: 26',
    ],
    [
      'field' => 'details[].status',
      'value' => 'Estado de la transacción (INITIALIZED, AUTHORIZED, REVERSED, FAILED, NULLIFIED, PARTIALLY_NULLIFIED, CAPTURED). Largo máximo: 64',
    ],
    [
      'field' => 'details[].balance',
      'value' => 'Monto restante para un detalle anulado. Largo máximo: 17',
    ],
  ],
  'webpay_plus_mall_refund' =>
  [
    [
      'field' => 'type',
      'value' => 'Tipo de reembolso (REVERSED o NULLIFIED). Si es REVERSED no se devolverán datos de la transacción (authorization code, etc). Largo máximo: 10',
    ],
    [
      'field' => 'authorization_code',
      'value' => '(Solo si es NULLIFIED) Código de autorización de la anulación. Largo máximo: 6',
    ],
    [
      'field' => 'authorization_date',
      'value' => '(Solo si es NULLIFIED) Fecha y hora de la autorización.',
    ],
    [
      'field' => 'balance',
      'value' => '(Solo si es NULLIFIED) Saldo actualizado de la transacción (considera la venta menos el monto anulado). Largo máximo: 17',
    ],
    [
      'field' => 'nullified_amount',
      'value' => '(Solo si es NULLIFIED) Monto anulado. Largo máximo: 17',
    ],
    [
      'field' => 'response_code',
      'value' => '(Solo si es NULLIFIED) Código de resultado de la reversa/anulación. Si es exitoso es 0, de lo contrario la reversa/anulación no fue realizada Largo Máximo: 2',
    ],
  ],
  'webpay_plus_deferred_captured' =>
  [
    [
      'field' => 'token',
      'value' => 'Token de la transacción. Largo máximo: 64',
    ],
    [
      'field' => 'authorization_code',
      'value' => 'Código de autorización de la captura diferida. Largo máximo: 6',
    ],
    [
      'field' => 'authorization_date',
      'value' => 'Fecha y hora de la autorización.',
    ],
    [
      'field' => 'captured_amount',
      'value' => 'Monto capturado. Largo máximo: 6',
    ],
    [
      'field' => 'response_code',
      'value' => 'Código de resultado de la captura. Si es exitoso es 0,de lo contrario la captura no fue realizada. Largo máximo: 2',
    ],
  ],
  'webpay_plus_mall_deferred_captured' =>
  [
    [
      'field' => 'token',
      'value' => 'Token de la transacción. Largo máximo: 64',
    ],
    [
      'field' => 'authorization_code',
      'value' => 'Código de autorización de la captura diferida. Largo máximo: 6',
    ],
    [
      'field' => 'authorization_date',
      'value' => 'Fecha y hora de la autorización.',
    ],
    [
      'field' => 'captured_amount',
      'value' => 'Monto capturado. Largo máximo: 6',
    ],
    [
      'field' => 'response_code',
      'value' => 'Código de resultado de la captura. Si es exitoso es 0,de lo contrario la captura no fue realizada. Largo máximo: 2',
    ],
  ],
  "oneclick_mall_authorize" =>
  [
    [
      'field' => 'buy_order',
      'value' => 'Orden de compra de la tienda del mall. Este número debe ser único para cada transacción. Largo máximo: 26. La orden de compra puede tener: Números, letras, mayúsculas y minúsculas, y los signos |_=&%.,~:/?[+!@()>-. Los caracteres con signos no están soportados, como los acentos o signos no especificados.',
    ],
    [
      'field' => 'card_detail',
      'value' => 'Objeto que contiene información de la tarjeta utilizado por el tarjetahabiente.',
    ],
    [
      'field' => 'card_detail.card_number',
      'value' => 'Los últimos 4 dígitos de la tarjeta usada en la transacción.',
    ],
    [
      'field' => 'accounting_date',
      'value' => 'Fecha contable de la autorización del pago.',
    ],
    [
      'field' => 'transaction_date',
      'value' => 'Fecha completa (timestamp) de la autorización del pago. ISO 8601',
    ],
    [
      'field' => 'details',
      'value' => 'Lista con el resultado de cada transacción de las tiendas.',
    ],
    [
      'field' => 'details [].amount',
      'value' => 'Monto de la transacción de pago.',
    ],
    [
      'field' => 'details [].status',
      'value' => 'Estado de la transacción (INITIALIZED, AUTHORIZED, REVERSED, FAILED, NULLIFIED, PARTIALLY_NULLIFIED, CAPTURED).',
    ],
    [
      'field' => 'details [].authorization_code',
      'value' => 'Código de autorización de la transacción de pago.',
    ],
    [
      'field' => 'details [].payment_type_code',
      'value' => [
        'Tipo de pago de la transaccion.',
        'VD = Venta Débito.',
        'VP = Venta prepago',
        'VN = Venta Normal.',
        'VC = Venta en cuotas.',
        'SI = 3 cuotas sin interés.',
        'S2 = 2 cuotas sin interés.',
        'NC = N Cuotas sin interés',
      ],
    ],
    [
      'field' => 'details [].response_code',
      'value' => [
        'Código del resultado del pago, donde: 0 (cero) es aprobado. Valores posibles:',
        '0 = Transacción aprobada',
        'Algunos códigos específicos para Oneclick son:',
        '-96: tbk_user no existente',
        '-97: Límites Oneclick, máximo monto diario de pago excedido.',
        '-98: Límites Oneclick, máximo monto de pago excedido',
        '-99: Límites Oneclick, máxima cantidad de pagos diarios excedido.',
      ],
    ],
    [
      'field' => 'details [].installments_number',
      'value' => 'Cantidad de cuotas de la transacción de pago.',
    ],
    [
      'field' => 'details [].commerce_code',
      'value' => 'Código de comercio del comercio hijo (tienda).',
    ],
    [
      'field' => 'details [].buy_order',
      'value' => 'Orden de compra generada por el comercio hijo para la transacción de pago.',
    ],
  ],

  "oneclick_mall_status" =>
  [
    [
      'field' => 'buy_order',
      'value' => 'Orden de compra de la tienda del mall. Este número debe ser único para cada transacción. Largo máximo: 26. La orden de compra puede tener: Números, letras, mayúsculas y minúsculas, y los signos |_=&%.,~:/?[+!@()>-. Los caracteres con signos no están soportados, como los acentos o signos no especificados.',
    ],
    [
      'field' => 'card_detail',
      'value' => 'Objeto que contiene información de la tarjeta utilizado por el tarjetahabiente.',
    ],
    [
      'field' => 'card_detail.card_number',
      'value' => 'Los últimos 4 dígitos de la tarjeta usada en la transacción.',
    ],
    [
      'field' => 'accounting_date',
      'value' => 'Fecha contable de la autorización del pago.',
    ],
    [
      'field' => 'transaction_date',
      'value' => 'Fecha completa (timestamp) de la autorización del pago. ISO 8601',
    ],
    [
      'field' => 'details',
      'value' => 'Lista con el resultado de cada transacción de las tiendas.',
    ],
    [
      'field' => 'details [].amount',
      'value' => 'Monto de la transacción de pago.',
    ],
    [
      'field' => 'details [].status',
      'value' => 'Estado de la transacción (INITIALIZED, AUTHORIZED, REVERSED, FAILED, NULLIFIED, PARTIALLY_NULLIFIED, CAPTURED).',
    ],
    [
      'field' => 'details [].authorization_code',
      'value' => 'Código de autorización de la transacción de pago.',
    ],
    [
      'field' => 'details [].payment_type_code',
      'value' => [
        'Tipo de pago de la transaccion.',
        'VD = Venta Débito.',
        'VP = Venta prepago',
        'VN = Venta Normal.',
        'VC = Venta en cuotas.',
        'SI = 3 cuotas sin interés.',
        'S2 = 2 cuotas sin interés.',
        'NC = N Cuotas sin interés',
      ],
    ],
    [
      'field' => 'details [].response_code',
      'value' => [
        'Código del resultado del pago, donde: 0 (cero) es aprobado. Valores posibles:',
        '0 = Transacción aprobada',
        'Algunos códigos específicos para Oneclick son:',
        '-96: tbk_user no existente',
        '-97: Límites Oneclick, máximo monto diario de pago excedido.',
        '-98: Límites Oneclick, máximo monto de pago excedido',
        '-99: Límites Oneclick, máxima cantidad de pagos diarios excedido.',
      ],
    ],
    [
      'field' => 'details [].installments_number',
      'value' => 'Cantidad de cuotas de la transacción de pago.',
    ],
    [
      'field' => 'details [].commerce_code',
      'value' => 'Código de comercio del comercio hijo (tienda).',
    ],
    [
      'field' => 'details [].buy_order',
      'value' => 'Orden de compra generada por el comercio hijo para la transacción de pago.',
    ],
  ],

  "oneclick_mall_refund" =>
  [
    [
      'field' => 'type',
      'value' => 'Tipo de reembolso, REVERSED o NULLIFIED, si es REVERSED no se devolverán datos de la transacción (authorization code, etc). Largo máximo: 10',
    ],
    [
      'field' => 'authorization_code',
      'value' => '(Solo si es NULLIFIED) Código de autorización. Largo máximo: 6',
    ],
    [
      'field' => 'authorization_date',
      'value' => '(Solo si es NULLIFIED) Fecha de la autorización de la transacción.',
    ],
    [
      'field' => 'nullified_amount',
      'value' => '(Solo si es NULLIFIED) Monto anulado. Largo máximo: 17',
    ],
    [
      'field' => 'balance',
      'value' => '(Solo si es NULLIFIED) Monto restante de la transacción de pago original: monto inicial – monto anulado. Largo máximo: 17',
    ],
    [
      'field' => 'response_code',
      'value' => '(Solo si es NULLIFIED) Código del resultado del pago, donde: 0 (cero) es aprobado. Largo máximo: 2',
    ],
    [
      'field' => 'buy_order',
      'value' => '(Solo si es NULLIFIED) Orden de compra generada por el comercio hijo para la transacción de pago. Largo máximo: 26.',
    ],
  ],

  "oneclick_mall_capture" =>
  [
    [
      'field' => 'authorization_code',
      'value' => 'Código de autorización de la captura diferida. Largo máximo: 6',
    ],
    [
      'field' => 'authorization_date',
      'value' => 'Fecha y hora de la autorización.',
    ],
    [
      'field' => 'captured_amount',
      'value' => 'Monto capturado. Largo máximo: 6',
    ],
    [
      'field' => 'response_code',
      'value' => 'Código de resultado de la captura. Si es exitoso es 0,de lo contrario la captura no fue realizada. Largo máximo: 2',
    ],
  ],
];
