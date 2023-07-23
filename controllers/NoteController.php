<?php

namespace MyApp\Controllers;

use MyApp\models\Note;
use MyApp\src\Application;
use MyApp\src\Controller;
use MyApp\src\Request;

class NoteController extends Controller
{
    function indexAction()
    {
        $noteModel= new Note();

     $noteModel->loadData($noteModel->getNotes());

        if($noteModel->getNotes()){
            $allNotes= get_object_vars($noteModel);

            array_splice($allNotes,0,6);


            $notesArray=array_filter($allNotes,function ($allNotes){return array_key_exists('id',$allNotes);});
            $commentsArray=array_filter($allNotes,function ($allNotes){return array_key_exists('comment',$allNotes);});


            return $this->render('all_notes_page',[
                'notes'=>$notesArray,
                'comments'=>$commentsArray
            ]);
        }

        return $this->render('all_notes_page',[
            'notes'=>false
        ]);
    }


    function createNote()
    {
        $noteModel= new Note();

        return $this->render('add_note_page',[
            'model' => $noteModel
        ]);
    }
    function editNote(Request $request)
    {

        $noteModel= new Note();

        $noteModel->loadData($request->getBody());
        $noteModel->loadData($noteModel->getNote($noteModel));

        if($noteModel->getNote($noteModel)){

             return $this->render('edit_note_page',[
                 'model'=>$noteModel
             ]);
        }
        return "Something went wrong";
    }
    function deleteNote(Request $request)
    {
        $noteModel= new Note();

        $noteModel->loadData($request->getBody());
        $noteModel->loadData($noteModel->getNote($noteModel));

        if($noteModel->getNote($noteModel)){

            return $this->render('delete_note_page',[
                'model'=>$noteModel
            ]);
        }
        return "Something went wrong";
    }

    function commentNote(Request $request)
    {
        $noteModel= new Note();

        $noteModel->loadData($request->getBody());
        $noteModel->loadData($noteModel->getNote($noteModel));

        if($noteModel->getNote($noteModel)){

            return $this->render('comment_note_page',[
                'model'=>$noteModel
            ]);
        }
        return "Something went wrong";
    }

    //POST FUNCTIONS
    function addNote(Request $request)
    {

        $noteModel= new Note();
        $noteModel->loadData($request->getBody());

        if($noteModel->validate() && $noteModel->insertNote()){
            header('Location: /allNotes');
        }


        return $this->render('add_note_page',[
            'model' => $noteModel
        ]);
    }
    function updateNote(Request $request)
    {
        $noteModel= new Note();
        $noteModel->loadData($request->getBody());

        if($noteModel->validate() && $noteModel->update($noteModel)){
            header('Location: /allNotes');
        }


        return $this->render('edit_note_page',[
            'model' => $noteModel
        ]);
    }
    function destroyNote(Request $request)
    {

        $noteModel= new Note();
        $noteModel->loadData($request->getBody());

        if($noteModel->validate() && $noteModel->destroy($noteModel)){
            header('Location: /allNotes');
        }


        return $this->render('delete_note_page',[
            'model' => $noteModel
        ]);
    }
    function addComment(Request $request)
    {

        $noteModel= new Note();
        $noteModel->loadData($request->getBody());


        if($noteModel->validate() && $noteModel->insertComment()){
            header('Location: /allNotes');
        }

        return $this->render('comment_note_page',[
            'model' => $noteModel
        ]);
    }
}