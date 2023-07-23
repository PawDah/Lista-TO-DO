<?php

namespace MyApp\src;

use PDO;

abstract class DbModel extends Model
{
    abstract public function noteTableName() : string;
    abstract public function commentsTableName() : string;

    abstract public function attributes() : array;

    public function save()
    {
        $tableName=$this->noteTableName();
        $attributes=$this->attributes();

        return $this->InsertIntoDatabase($attributes, $tableName);
    }
    public function getById($noteModel)
    {

        $note=get_object_vars($noteModel);

        $tableName=$this->noteTableName();

        $statement = self::prepare("SELECT * FROM  $tableName  WHERE id = ".$note['id']);


        $statement->execute();
        $result=$statement->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
    public function getAllNotes()
    {

        $noteTableName=$this->noteTableName();
        $commentTableName=$this->commentsTableName();

        $statementNotes = self::prepare("SELECT  * FROM  $noteTableName");
         $statementComments = self::prepare("SELECT  comment,comment_Note FROM  $commentTableName");


        $statementNotes->execute();
        $statementComments->execute();

        $resulNotes=$statementNotes->fetchAll(PDO::FETCH_ASSOC);
        $resulComments=$statementComments->fetchAll(PDO::FETCH_ASSOC);

        $result=array_merge($resulComments,$resulNotes);

        return $result;
    }
    public function delete($noteModel)
    {
        $note=get_object_vars($noteModel);

        $tableName=$this->noteTableName();


        $statement = self::prepare("DELETE FROM  $tableName  WHERE id = ".$note['id']);


        $statement->execute();


        return true;


    }
    public function saveComment()
    {

        $tableName=$this->commentsTableName();

        $attributes=['comment','comment_Note'];
        return $this->InsertIntoDatabase($attributes, $tableName);
    }
    public function edit($noteModel)
    {
        $note=get_object_vars($noteModel);

        $tableName=$this->noteTableName();
        $attributes=$this->attributes();

        $params = array_map(fn($attr)=>":$attr",$attributes);
        $prepare=array_combine($attributes,$params);

       array_walk($prepare, function(&$value, $key) {
            $value = "{$key}={$value}";
        });

        $preparedArray=implode(',',$prepare);

        $statement = self::prepare("UPDATE $tableName SET ".$preparedArray." WHERE id=".$note['id']);

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute",$this->{$attribute});
        }

        $statement->execute();
        return true;
    }
    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }

    public function InsertIntoDatabase(array $attributes, string $tableName): bool
    {
        $params = array_map(fn($attr) => ":$attr", $attributes);

        $statement = self::prepare("INSERT INTO  $tableName (" . implode(',', $attributes) . ") VALUES(" . implode(',', $params) . ")");
        foreach ($attributes as $attribute) {

            $statement->bindValue(":$attribute", $this->{$attribute});
        }


        $statement->execute();
        return true;
    }

}