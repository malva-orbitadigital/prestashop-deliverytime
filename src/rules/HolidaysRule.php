<?php

require_once(_PS_MODULE_DIR_ . 'od_deliverytime/src/interface/DeliveryDateRangeRule.php');
require_once(_PS_MODULE_DIR_ . 'od_deliverytime/src/repository/HolidaysRepository.php');
class HolidaysRule implements DeliveryDateRangeRule
{

   public function apply(DeliveryDateRange $deliveryDateRange): DeliveryDateRange
   {
      $to = $deliveryDateRange->getTo();
      $from = $deliveryDateRange->getFrom();
      $now = $deliveryDateRange->getNow();
      
      $daysBetweenNowFrom =  HolidaysRepository::get('count(date)', "date BETWEEN '" . $now . "' AND '" . $from . "'");
      $daysBetweenFromTo = (int) HolidaysRepository::get('count(date)', "date BETWEEN '" . $from . "' AND '" . $to . "'");
      $deliveryDateRange->addDays($daysBetweenNowFrom);
      $deliveryDateRange->addDaysTo($daysBetweenFromTo);

      return $deliveryDateRange;
   }
}
