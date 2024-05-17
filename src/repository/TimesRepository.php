<?php
class TimesRepository
{

   protected $db;

   public function __construct()
   {
      $this->db = Db::getInstance();
   }

   public function createTable()
   {
      return $this->db->execute('CREATE TABLE IF NOT EXISTS ' . _DB_PREFIX_ . 'od_deliverytime_times (
         `id` INT AUTO_INCREMENT PRIMARY KEY,
         `ref_order` VARCHAR(9) NOT NULL,
         `min_date` DATETIME NOT NULL,
         `max_date` DATETIME NOT NULL
      ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;');
   }

   public function deleteTable()
   {
      return $this->db->execute('DROP TABLE `' . _DB_PREFIX_ . 'od_deliverytime_times`;');
   }
}
