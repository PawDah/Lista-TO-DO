<?php

namespace MyApp\models;
use MyApp\src\DbModel;
use MyApp\src\Model;
use PDO;

class Note extends DbModel {

    public $id='';
    public  $title='';
    public  $description='';
    public  $start_date='';
    public $end_date='';



    public function noteTableName(): string
    {
        return 'note';
    }
    public function commentsTableName(): string
    {
        return 'comments';
    }

    
    public function insertNote()
    {

       return  $this->save();

    }

    public function getNotes()
    {

        return  $this->getAllNotes();

    }
    public function getNote($noteModel)
    {


        return  $this->getById($noteModel);

    }
    public function destroy($noteModel)
    {
        return $this->delete($noteModel);
    }

    public function insertComment()
    {
        return $this->saveComment();
    }

    public function update($noteModel)
    {
        return $this->edit($noteModel);
    }
    public function rules(): array
    {
        return [
            'title' => [self::RULE_REQUIRED],
            'description' => [self::RULE_REQUIRED],
            'end_date' => [self::RULE_REQUIRED],
            'start_date' => [self::RULE_REQUIRED],
            ];
    }
    public function attributes(): array
    {
        return ['title','description','end_date','start_date'];
    }


}