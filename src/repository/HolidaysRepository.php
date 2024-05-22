<?php
class HolidaysRepository
{
   private const TABLE_NAME = 'od_deliverytime_holiday';

   static public function createTable(): bool
   {
      return Db::getInstance()->execute('CREATE TABLE IF NOT EXISTS ' . _DB_PREFIX_ . self::TABLE_NAME . ' (
         `id` INT AUTO_INCREMENT PRIMARY KEY,
         `date` DATETIME NOT NULL,
         `name` VARCHAR(255) NOT NULL
      ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;');
   }

   static public function deleteTable(): bool
   {
      return Db::getInstance()->execute('DROP TABLE `' . _DB_PREFIX_ . self::TABLE_NAME . '`;');
   }

   static public function insert(array $data): bool
   {
      if (empty($data)) return false;
      return Db::getInstance()->insert(self::TABLE_NAME, [$data]);
   }

   static public function getAll(){
      return Db::getInstance()->executeS('SELECT * FROM ' . _DB_PREFIX_ . self::TABLE_NAME);
   }

   static public function get(string $select = '*', string $where){
      $wherestr = $where !== '' ? ' where ' . $where : '';
      $sql = 'SELECT '.$select.' FROM ' . _DB_PREFIX_ . self::TABLE_NAME . $wherestr;
      return Db::getInstance()->executeS($sql)[0]['count(date)'];
   }
}
