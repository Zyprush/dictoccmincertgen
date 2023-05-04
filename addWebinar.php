<?php
    include('includes/header.php');
?>

<div class="container">
    <h1 class="my-4">Add webinar event</h1>
    <h3 class="my-4">Webinar details</h3>

    <form action="code.php" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="webinar_title" name="webinar_title" required>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="webinar_date" name="webinar_date" required>
        </div>

        <div class="mb-3">
            <label for="link" class="form-label">Meeting link</label>
            <input type="url" class="form-control" id="webinar_link" name="webinar_link" required>
        </div>

        <div class="row">
            <div class="col-sm-6 mb-3">
                <button type="button" class="btn btn-secondary btn-block">Generate registration form link</button>
            </div>
            <div class="col-sm-6 mb-3">
                <button type="button" class="btn btn-secondary btn-block">Generate assessment form link</button>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 mb-3">
                <button type="submit" class="btn btn-primary btn-block" name="save_webinar">Submit</button>
            </div>
            <div class="col-sm-6 mb-3">
                <button type="button" class="btn btn-danger btn-block">Cancel</button>
            </div>
        </div>
    </form>
</div>

<?php
    include('includes/footer.php');
?>
 