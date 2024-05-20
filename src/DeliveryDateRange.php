<?php

class DeliveryDateRange {
   
   private $now;
   private $from;
   private $to;
   private $id_product = 0;

   public function __construct($id_product, $from, $to) {
      $this->id_product = $id_product;
      $this->from = $from;
      $this->to = $to;
      $this->now = new DateTime();
   }

}