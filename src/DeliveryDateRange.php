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
      // $this->to->modify('+1 day');
   }

   public function addDaysFrom(int $numDays)
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

   public function daysBetween(): int
   {
      return $this->now->diff($this->to)->days;
   }

   public function getTo()
   {
      return $this->to->format('Y-m-d H:i:s');
   }

   public function getFrom()
   {
      return $this->from->format('Y-m-d H:i:s');
   }

   public function getNow()
   {
      return $this->now->format('Y-m-d H:i:s');
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
      return $this->from->format('Y-m-d') == $this->to->format('Y-m-d');
   }

   public function __toString()
   {
      return $this->sameDay() ? 'Recíbelo el ' . $this->format($this->from)
      : 'Recíbelo entre el ' . $this->format($this->from) . ' y el ' . $this->format($this->to);
   }
}
