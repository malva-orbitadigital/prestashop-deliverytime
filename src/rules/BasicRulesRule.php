<?php

require_once(_PS_MODULE_DIR_ . 'od_deliverytime/src/interface/DeliveryDateRangeRule.php');
class BasicRulesRule implements DeliveryDateRangeRule
{

   public function apply(DeliveryDateRange $deliveryDateRange): DeliveryDateRange{


      return $deliveryDateRange;
   }
}
