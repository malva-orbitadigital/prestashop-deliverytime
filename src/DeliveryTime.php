<?php


class DeliveryTime{

   
   
   public function ofProduct(int $id_product)
   {
   }

   public function ruleRunner(DeliveryDateRange $dataRange, array $rules)
   {
      foreach ($rules as $rule) {
         $rule->apply($dataRange);
      }
   }

}