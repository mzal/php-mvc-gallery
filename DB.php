<?php

class DB {
  public static $db;

  public static function get_db() {
    $mongo = new MongoDB\Client(
      "mongodb://127.0.0.1:27017/wai",
      [
        'username' => 'wai_web',
        'password' => 'w@i_w3b'
      ]);

    DB::$db = $mongo->wai;
  }
  public static function save_document($collection, $document) {
    return DB::$db->$collection->insertOne($document)->getInsertedId();
  }
  public static function load_document($collection, $field, $value){
    return DB::$db->$collection->findOne([$field => $value]);
  }
  public static function get_document_by_id($collection, $id) {
    $query = [
      "_id" => new MongoDB\BSON\ObjectId($id)
    ];
    return DB::$db->$collection->findOne($query);
  }
  public static function get_all_from_collection($collection) {
    return DB::$db->$collection->find();
  }
  public static function drop_collection($collection) {
    DB::$db->$collection->drop();
  }
  public static function check_if_value_exists($collection, $field, $value) {
    $query = [
      $field => $value
    ];
    $result = DB::$db->$collection->findOne($query);
    if ($result) {
      return true;
    }
    return false;
  }
  public static function value_by_id($collection, $field, $id) {
    $document = DB::get_document_by_id($collection, $id);
    return $document[$field];
  }
}
