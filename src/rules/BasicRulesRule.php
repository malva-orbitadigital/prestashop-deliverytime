<?php

require_once(_PS_MODULE_DIR_ . 'od_deliverytime/src/interface/DeliveryDateRangeRule.php');
class BasicRulesRule implements DeliveryDateRangeRule
{
   // ! Ultima regla que se aplicará
   // TODO añadir un dia de envio (preparacion pedido) 
   // TODO calcular fines de semana

   public function apply(DeliveryDateRange $deliveryDateRange): DeliveryDateRange
   {
      // shippment
      $deliveryDateRange->addDays(1);

      // weekends
      $now = $deliveryDateRange->getNow();
      $to = $deliveryDateRange->getTo();
      $diff = $deliveryDateRange->daysBetween();

      for($i = 0; $i < $diff; $i++) {
         
      }

      return $deliveryDateRange;
   }
}
