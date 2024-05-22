<?php

require_once(_PS_MODULE_DIR_ . 'od_deliverytime/src/rules/AvailableStockRule.php');
require_once(_PS_MODULE_DIR_ . 'od_deliverytime/src/rules/BasicRulesRule.php');
require_once(_PS_MODULE_DIR_ . 'od_deliverytime/src/rules/HolidaysRule.php');
require_once(_PS_MODULE_DIR_ . 'od_deliverytime/src/rules/WorkingHoursRule.php');
require_once(_PS_MODULE_DIR_ . 'od_deliverytime/src/DeliveryDateRange.php');

class DeliveryTime
{

   public function ofProduct(int $id_product): DeliveryDateRange
   {
      return $this->ruleRunner(new DeliveryDateRange($id_product), [
         new AvailableStockRule(),
         new BasicRulesRule(),
         new WorkingHoursRule(17),
         new HolidaysRule()
      ]);
   }

   public function ruleRunner(DeliveryDateRange $dataRange, array $rules): DeliveryDateRange
   {
      foreach ($rules as $rule) {
         $dataRange = $rule->apply($dataRange);
      }
      return $dataRange;
   }
}
