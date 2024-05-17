<?php
interface DeliveryDateRangeRule
{

   public function apply(DeliveryDateRange $deliveryDateRange): DeliveryDateRange;
   
}
