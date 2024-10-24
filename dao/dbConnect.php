<?php
class DbConnect
// Singleton 
{
   private static ?PDO $connection = null;
   private const HOST = "localhost";
   private const DBNAME = "guide";
   private const USER = "root";
   private const PWD = "";

   private function  __construct() {}
   // public function tryConnect(): ?PDO
   // {
   //    try {
   //       $myConnection = new PDO("mysql:host=$this->hote;dbname=$this->dbName;charset=utf8", $this->user, $this->pasword);
   //       return $myConnection;
   //    } catch (PDOException $e) {
   //       echo "ereur connexion :" . $e->getMessage();

   //       return null;
   //    }
   // }
   public static function getInstance(): PDO // 
   {
      if (is_null(self::$connection)) {
         self::$connection = new PDO("mysql:host=".self::HOST.";dbname=".self::DBNAME.";charset=utf8",self::USER, self::PWD);
      }
      return self::$connection;
   }
}
   