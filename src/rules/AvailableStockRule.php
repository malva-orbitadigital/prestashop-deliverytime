<?php

require_once(_PS_MODULE_DIR_ . 'od_deliverytime/src/interface/DeliveryDateRangeRule.php');
class AvailableStockRule implements DeliveryDateRangeRule
{
   // ! Orden de regla  2 (no es necesario saber el porque del orden de este archivo)
   // TODO si el producto tiene 0 se añadirá entre 1 a 2 dias
   // TODO si el producto tiene mas que 10 se añadirá entre 2 a 4 dias
   // TODO si el producto tiene mas que 50 se añadirá entre 3 a 5 dias

   public function apply(DeliveryDateRange $deliveryDateRange): DeliveryDateRange
   {
      $quantity = StockAvailable::getQuantityAvailableByProduct($deliveryDateRange->id_product, 0);
      if ($quantity <= 10) {
         $deliveryDateRange->addDays(1, 2);
      } elseif ($quantity <= 50) {
         $deliveryDateRange->addDays(2, 4);
      } else {
         $deliveryDateRange->addDays(3, 5);
      }

      return $deliveryDateRange;
   }
}
