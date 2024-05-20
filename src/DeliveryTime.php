<?php

require_once(_PS_MODULE_DIR_ . 'od_deliverytime/src/rules/AvailableStockRule.php');
require_once(_PS_MODULE_DIR_ . 'od_deliverytime/src/rules/BasicRulesRule.php');
require_once(_PS_MODULE_DIR_ . 'od_deliverytime/src/rules/HolidaysRule.php');
require_once(_PS_MODULE_DIR_ . 'od_deliverytime/src/rules/WorkingHoursRule.php');
class DeliveryTime
{

   private $availableStockRule;
   private $basicRulesRule;
   private $holidaysRule;
   private $workingHoursRule;


   public function __construct()
   {
      $this->availableStockRule = new AvailableStockRule();
      $this->basicRulesRule = new BasicRulesRule();
      $this->holidaysRule = new HolidaysRule();
      $this->workingHoursRule = new workingHoursRule();
   }

   public function ofProduct(int $id_product)
   {
      $product = new Product($id_product);
   }

   public function ruleRunner(DeliveryDateRange $dataRange, array $rules): DeliveryDateRange
   {
      foreach ($rules as $rule) {
         $dataRange = $rule->apply($dataRange);
      }
      return $dataRange;
   }
}
