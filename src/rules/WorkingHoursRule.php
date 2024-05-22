<?php

require_once(_PS_MODULE_DIR_ . 'od_deliverytime/src/interface/DeliveryDateRangeRule.php');
require_once(_PS_MODULE_DIR_ . 'od_deliverytime/src/repository/HolidaysRepository.php');

class WorkingHoursRule implements DeliveryDateRangeRule
{
   // private int $endHour;
   // private int $endMinute;

   public function __construct(int $endHour, int $endMinute = 0)
   {
      $this->endHour = $endHour;
      $this->endMinute = $endMinute;
   }

   // ! Orden de la regla 1 ¿porque?

   public function apply(DeliveryDateRange $deliveryDateRange): DeliveryDateRange
   {


      return $deliveryDateRange;
   }
}
