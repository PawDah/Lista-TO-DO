<?php
$convertToArray=( explode(' ',$model->end_date));
$convertToString=implode("-",$convertToArray);
$finaldate=( explode('-',$convertToString));
$convertToArray2=( explode(' ',$model->start_date));
$convertToString2=implode("-",$convertToArray);
$finaldate2=( explode('-',$convertToString));
?>

<h1 class="text-center mt-3">Usuwanie Notatki</h1>

<main class="container mt-5">
    <form class="col-lg-6 offset-lg-3 " action="" method="post">
        <div class="form-group ">
            <label for="title">Tytuł</label>
            <input readonly type="name" name="title" class="form-control" id="title" value="<?php echo $model->title ?>" required>
        </div>
        <div class="form-group">
            <label  class="form-label">Opis</label>
            <textarea readonly style="max-height: 400px" class="form-control" rows="8" name="description"  required><?php echo $model->description ?></textarea>
        </div>
        <div class="form-group">
                <label for="start_date">Data rozpoczęcia:</label>
            <?php if (checkdate($finaldate[1],$finaldate[2],$finaldate[0])&& !array_key_exists('3',$finaldate)) { ?>
                <input readonly value="<?php echo $model->start_date ?>" type="date" id="start_date" name="start_date">
            <?php } else { ?>
                <input readonly value="<?php echo $model->start_date ?>" type="datetime-local" id="start_date" name="start_date">
            <?php } ?>
            <label for="end_date">Data zakończenia:</label>
            <?php if (checkdate($finaldate[1],$finaldate[2],$finaldate[0])&& !array_key_exists('3',$finaldate)) { ?>
                <input readonly value="<?php echo $model->end_date ?>" type="date" id="end_date" name="end_date">
            <?php } else { ?>
                <input readonly value="<?php echo $model->end_date ?>" type="datetime-local" id="end_date" name="end_date">
            <?php } ?>
        </div>
        <h3 class="text-center mt-5">Czy jesteś pewny że chcesz usunąć tą notatkę?</h3>
        <div class="d-flex justify-content-end">

            <input type="hidden" name="id" value="<?php echo $model->id ?>">
            <button type="submit" class="btn m-1 btn-danger col-lg-6 offset-lg-3 mt-4">Usuń</button>
            <a class="btn m-1  col-lg-6 offset-lg-3 mt-4  btn-secondary" href="/allNotes">Anuluj</a>

        </div>


    </form>
</main>


