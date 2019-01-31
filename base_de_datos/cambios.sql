ALTER TABLE `registro_pagos_anuncios` ADD `porcentaje_pago` DECIMAL(10,2) NULL AFTER `estado_pago`; 
UPDATE `registro_pagos_anuncios` SET `porcentaje_pago` = '4' 