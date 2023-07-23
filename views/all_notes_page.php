
<main class="container mt-5">



    <h1 class="text-center">Tutaj znajdziesz wszystkie swoje notatki</h1>

    <?php if (!$notes) { ?>
        <h2 class="mt-5">Brak notatek w bazie</h2>
    <?php } else { ?>

    <div class="container mt-4">
        <div class="row">
            <?php foreach($notes as $note): ?>


            <div class="col-lg-4 mb-5">
                <div class="card card-margin">
                    <div class="card-header no-border">
                        <h3 class="card-title text-center">
                            <?php echo $note['title'];?>
                        </h3>
                    </div>
                    <div class="card-body pt-0">
                        <div class="widget-49">
                            <div class="widget-49-title-wrapper">
                                <div class="widget-49-date-primary m-2">
                                        <p class="text-left p-2">Data rozpoczęcia:
                                            <?php echo  $note['start_date']; ?>
                                        </p>
                                    <span class="text-left p-2">Data zakończenia:
                                        <?php echo  $note['end_date'] ?>
                                    </span>
                                </div>

                            </div>
                            <p class="text-center p-4">
                                <?php echo  $note['description']; ?>
                            </p>
                            <div class="widget-49-meeting-action">
                                <div class="d-flex justify-content-end">

                                    <a class="btn m-1 btn-primary" href="editNote?id=<?php echo $note['id'];?>">Edytuj</a>
                                    <a class="btn m-1 btn-warning" href="commentNote?id=<?php echo $note['id'];?>">Skomentuj</a>
                                    <a class="btn m-1 btn-danger" href="deleteNote?id=<?php echo $note['id'];?>">Usuń</a>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <p>Komentarze:</p>
                <ul class="list-group">

                <?php
                foreach($comments as $comment){
                    if ($comment['comment_Note']===$note['id']){

                        echo "<li class='list-group-item'>".$comment['comment']."</li>";

                    }
                }
                ?>
                </ul>

            </div>
   <?php endforeach; ?>
        </div>
    </div>
    <?php } ?>
</main>




