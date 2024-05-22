<?php

require_once(_PS_MODULE_DIR_ . 'od_deliverytime/src/interface/DeliveryDateRangeRule.php');
class AvailableStockRule implements DeliveryDateRangeRule
{
   // ! Orden de regla  2 (no es necesario saber el porque del orden de este archivo)
   // TODO si el producto tiene 0 se añadirá entre 1 a 2 dias
   // TODO si el producto tiene mas que 10 se añadirá entre 2 a 4 dias
   // TODO si el producto tiene mas que 50 se añadirá entre 3 a 5 dias

   public function apply(DeliveryDateRange $deliveryDateRange): DeliveryDateRange{

      // StockAvailable::outOfStock($deliveryDateRange->id_product);

      return $deliveryDateRange;
   }
}
