<?php
class HolidaysRepository
{
   private $tablename = 'od_deliverytime_holiday';

   public function createTable(): bool
   {
      return Db::getInstance()->execute('CREATE TABLE IF NOT EXISTS ' . _DB_PREFIX_ . $this->tablename . ' (
         `id` INT AUTO_INCREMENT PRIMARY KEY,
         `date` DATETIME NOT NULL,
         `name` VARCHAR(255) NOT NULL
      ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;');
   }

   public function deleteTable(): bool
   {
      return Db::getInstance()->execute('DROP TABLE `' . _DB_PREFIX_ . $this->tablename . '`;');
   }

   public function insert(array $data): bool
   {
      if (empty($data)) return false;
      return Db::getInstance()->insert($this->tablename, [$data]);
   }

   public function getAll(){
      return Db::getInstance()->executeS('SELECT * FROM ' . _DB_PREFIX_ . $this->tablename);
   }
}
