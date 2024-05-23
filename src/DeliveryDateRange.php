<?php

class DeliveryDateRange
{

   private $now;
   private $from;
   private $to;
   public $id_product = 0;

   public function __construct(int $id_product)
   {
      $this->id_product = $id_product;
      $this->now = new DateTime();
      $this->from = clone $this->now;
      $this->to = clone $this->now;
      $this->to->modify('+1 day');
      // $this->now = new DateTime('2024-05-22');
      // $this->from = new DateTime('2024-05-24');
      // $this->to = new DateTime('2024-05-27');
   }

   private function addDaysFrom(int $numDays)
   {
      $this->from->modify('+' . $numDays . ' day');
   }

   public function addDaysTo(int $numDays)
   {
      $this->to->modify('+' . $numDays . ' day');
   }

   public function addDays(int $numDays)
   {
      $this->addDaysFrom($numDays);
      $this->addDaysTo($numDays);
   }

   /**
    * Days between now and start of range
    */
   public function daysBetweenNowFrom(): int
   {
      return $this->now->diff($this->from)->days;
   }

   /**
    * Days between now and end of range
    */
    public function daysBetweenFromTo(): int
    {
       return $this->from->diff($this->to)->days;
    }

   public function getTo()
   {
      return $this->to;
   }

   public function getFrom()
   {
      return $this->from;
   }

   public function getNow()
   {
      return $this->now;
   }

   public function format(DateTime $date)
   {
      $lang = Language::getIsoById(Context::getContext()->language->id) . '_es';
      $formatter = new IntlDateFormatter(
         $lang,
         IntlDateFormatter::LONG,
         IntlDateFormatter::LONG
      );

      return $formatter->formatObject($date, "EEEE, d 'de' MMMM", $lang);
   }

   public function sameDay()
   {
      // var_dump($this->from->format('Y-m-d')." ".$this->to->format('Y-m-d'));die();
      return $this->from->format('Y-m-d') == $this->to->format('Y-m-d');
   }

   public function __toString()
   {
      return $this->sameDay() ? 'Recíbelo el ' . $this->format($this->from)
      : 'Recíbelo entre el ' . $this->format($this->from) . ' y el ' . $this->format($this->to);
   }
}
