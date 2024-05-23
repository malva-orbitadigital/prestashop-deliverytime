<?php

require_once(_PS_MODULE_DIR_ . 'od_deliverytime/src/interface/DeliveryDateRangeRule.php');
class BasicRulesRule implements DeliveryDateRangeRule
{
   // ! Ultima regla que se aplicará
   // TODO añadir un dia de envio (preparacion pedido) 

   public function apply(DeliveryDateRange $deliveryDateRange): DeliveryDateRange
   {
      // shippment
      $deliveryDateRange->addDays(1);
      
      // weekends
      // sunday -> 0, saturday -> 6
      $now = $deliveryDateRange->getNow();
      $to = $deliveryDateRange->getTo();
      
      // $from = $deliveryDateRange->getFrom();
      // var_dump($from->format('Y-m-d')." ".$to->format('Y-m-d'));die();

      $diffNowFrom = $deliveryDateRange->daysBetweenNowFrom();
      
      for($i = 0; $i < $diffNowFrom; $i++) {
         $day = clone $now;
         $numDay = $day->modify('+' . $i . ' day')->format('w');
         if ($numDay == 0 || $numDay == 6){
            $deliveryDateRange->addDays(1);
         }
      }
      
      $from = $deliveryDateRange->getFrom();
      $numDayFrom = $from->format('w');
      if ($numDayFrom == 0){
         $deliveryDateRange->addDays(1);
      } else if ($numDayFrom == 6) {
         $deliveryDateRange->addDays(2);
      }

      $diffFromTo = $deliveryDateRange->daysBetweenFromTo();
      for($i = 1; $i < $diffFromTo; $i++) {
         $day = clone $from;
         $numDay = $day->modify('+' . $i . ' day')->format('w');
         if ($numDay == 0 || $numDay == 6){
            $deliveryDateRange->addDays(0, 1);
         }
      }

      $to = $deliveryDateRange->getTo();
      $numDayTo = $to->format('w');
      if ($numDayTo == 0){
         $deliveryDateRange->addDays(0, 1);
      } else if ($numDayTo == 6) {
         $deliveryDateRange->addDays(0, 2);
      }

      
      return $deliveryDateRange;
   }
}
