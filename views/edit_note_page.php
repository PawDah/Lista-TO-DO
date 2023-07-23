<?php
$convertToArray=( explode(' ',$model->end_date));
$convertToString=implode("-",$convertToArray);
$finalEndDate=( explode('-',$convertToString));
$convertToArray2=( explode(' ',$model->start_date));
$convertToString2=implode("-",$convertToArray);
$finalStartDate=( explode('-',$convertToString));
?>


<h1 class="text-center mt-3">Edycja Notatki</h1>

<main class="container mt-5">
    <form class="col-lg-8 offset-lg-2 " action="" method="post">
        <div class="form-group ">
            <label class="mb-3" for="title">Tytuł</label>
            <input type="name" name="title" class="form-control" id="title" value="<?php echo $model->title ?>" required placeholder="Wprowadź tytuł Notatki">
        </div>
        <div class="form-group">
            <label class="form-label mb-3 mt-3">Opis</label>
            <textarea style="max-height: 400px" class="form-control" rows="8" name="description"  required><?php echo $model->description ?></textarea>
        </div>
        <div class="form-group mt-3">
            <label for="start_date">Data rozpoczęcia:</label>
            <?php if (checkdate($finalStartDate[1],$finalStartDate[2],$finalStartDate[0])&& !array_key_exists('3',$finalStartDate)) { ?>
                <input  value="<?php echo $model->start_date ?>" type="date" id="start_date" name="start_date">
            <?php } else { ?>
                <input  value="<?php echo $model->start_date ?>" type="datetime-local" id="start_date" name="start_date">
            <?php } ?>
            <label for="end_date">Data zakończenia:</label>
            <?php if (checkdate($finalEndDate[1],$finalEndDate[2],$finalEndDate[0])&& !array_key_exists('3',$finalEndDate)) { ?>
                <input  value="<?php echo $model->end_date ?>" type="date" id="end_date" name="end_date">
            <?php } else { ?>
                <input  value="<?php echo $model->end_date ?>" type="datetime-local" id="end_date" name="end_date">
            <?php } ?>

        </div>

        <?php if (checkdate($finalEndDate[1],$finalEndDate[2],$finalEndDate[0])&& !array_key_exists('3',$finalEndDate)) { ?>
            <input type="checkbox" checked name="show" id="show" value="0" />
            <label for="show">Cały dzień</label>
        <?php } else { ?>
            <input type="checkbox"  name="show" id="show" value="0" />
            <label for="show">Cały dzień</label>
        <?php } ?>


        <div class="d-flex justify-content-end">

            <input type="hidden" name="id" value="<?php echo $model->id ?>">
            <button type="submit" class="btn m-1 btn-success col-lg-6 offset-lg-3 mt-4">Edytuj</button>
            <a class="btn m-1  col-lg-6 offset-lg-3 mt-4  btn-secondary" href="/allNotes">Cofnij</a>

        </div>




    </form>
</main>

<script>
    const checkbox = document.getElementById('show');

    const box = document.getElementById('box');
    const endDate = document.getElementById('end_date');
    const startDate = document.getElementById('start_date');
    checkbox.addEventListener('click', function handleClick() {
        if (checkbox.checked) {
            endDate.type ='date'
            startDate.type ='date'
            box.setAttribute('disabled','');
        } else {
            endDate.type='datetime-local'
            startDate.type='datetime-local'
            box.removeAttribute("disabled");
        }
    });
</script>
