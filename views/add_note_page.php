
<h1 class="text-center mt-3">Dodawanie Notatki</h1>

<main class="container mt-5" style="max-width: 960px">


<div class="card card-margin">
        <div class="card-header no-border">
            <div class="card-body ">
                    <form class="col-lg-6 offset-lg-3" action="" method="post">
                        <div class="form-group ">
                            <label for="title">Tytuł</label>
                            <input type="name" name="title" required class="form-control<?php echo $model->hasError('title') ? ' is-invalid' : '' ?>" id="title"  value="<?php echo $model->title ?>" placeholder="Wprowadź tytuł Notatki">
                            <div class=" invalid-feedback">
                                <?php echo $model->getError('title')?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="form-label">Opis</label>
                            <textarea style="max-height: 400px"  required class="form-control<?php echo $model->hasError('description') ? ' is-invalid' : '' ?>" rows="8" name="description" ></textarea>
                            <div class=" invalid-feedback">
                                <?php echo $model->getError('description')?>
                            </div>
                        </div>
                        <div class="form-group">

                            <div   style="visibility:visible">
                                <label  class="mt-2 " for="start_date">Data rozpoczęcia:</label>
                                <input class="form-control<?php echo $model->hasError('start_date') ? ' is-invalid' : '' ?>" type="datetime-local" id="start_date" name="start_date">
                                <div class=" invalid-feedback">
                                    <?php echo $model->getError('start_date')?>
                                </div>
                            </div>

                            <label  class="mt-2" for="end_date">Data zakończenia:</label>
                            <input required  class="form-control<?php echo $model->hasError('end_date') ? ' is-invalid' : '' ?>"  type="datetime-local" id="end_date" name="end_date">
                            <div class=" invalid-feedback">
                                <?php echo $model->getError('end_date')?>
                            </div>
                            <input type="checkbox" name="show" id="show" value="0" />
                            <label for="show">Cały dzień</label>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success px-2 mt-4 mx-2">Dodaj</button>
                            <a class="btn  btn-danger  px-2 mt-4 mx-2 mt-4" href="/">Anuluj</a>

                        </div>
                    </form>
            </div>
        </div>
    </div>
</main>

<script>
    const checkbox = document.getElementById('show');
    const endDate = document.getElementById('end_date');
    const startDate = document.getElementById('start_date');
    checkbox.addEventListener('click', function handleClick() {
        if (checkbox.checked) {
            endDate.type ='date'
            startDate.type ='date'
        } else {
            endDate.type='datetime-local'
            startDate.type='datetime-local'
        }
    });
</script>

