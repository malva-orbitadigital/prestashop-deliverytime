<?php
class TimesRepository
{

   private const TABLE_NAME = 'od_deliverytime_times';

   static public function createTable()
   {
      return Db::getInstance()->execute('CREATE TABLE IF NOT EXISTS ' . _DB_PREFIX_ . 'od_deliverytime_times (
         `id` INT AUTO_INCREMENT PRIMARY KEY,
         `ref_order` VARCHAR(9) NOT NULL,
         `min_date` DATETIME NOT NULL,
         `max_date` DATETIME NOT NULL
      ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;');
   }

   static public function deleteTable()
   {
      return Db::getInstance()->execute('DROP TABLE `' . _DB_PREFIX_ . 'od_deliverytime_times`;');
   }
}
