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
      
      $daysBetweenNowFrom =  HolidaysRepository::get('count(date)', "date BETWEEN '" . $now->format('Y-m-d H:i:s') . "' AND '" . $from->format('Y-m-d H:i:s') . "'");
      $daysBetweenFromTo = (int) HolidaysRepository::get('count(date)', "date BETWEEN '" . $from->format('Y-m-d H:i:s') . "' AND '" . $to->format('Y-m-d H:i:s') . "'");
      $deliveryDateRange->addDays($daysBetweenNowFrom);
      $deliveryDateRange->addDaysTo($daysBetweenFromTo);

      return $deliveryDateRange;
   }
}
