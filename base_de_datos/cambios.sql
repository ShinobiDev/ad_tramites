ALTER TABLE `registro_pagos_anuncios` CHANGE `estado_pago` `estado_pago` ENUM('APROBADA','PENDIENTE','RECHAZADA','DOCUMENTACION SOLICITADA','DOCUMENTACION RECIBIDA','TRAMITE REALIZADO','PAGO A TRAMITADOR','TRANSACCION FINALIZADA') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDIENTE';
ALTER TABLE `registro_pagos_anuncios` CHANGE `estado_pago` `estado_pago` ENUM('APROBADA','PENDIENTE','RECHAZADA','TRAMITE REALIZADO','PAGO A TRAMITADOR','TRANSACCION FINALIZADA','PAGO TRAMITADOR CONFIRMADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDIENTE'; 