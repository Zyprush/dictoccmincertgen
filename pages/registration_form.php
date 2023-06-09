    <?php
        include('../includes/headers.php');

        if (!isset($_GET['webinar_id'])) {
            // Redirect the user to the webinar list page
            header('location: 404.php');
            exit();
        }

        // Get the webinar_id parameter from the query string
        $webinar_id = $_GET['webinar_id'];
    ?>

    <div class="container">
        <div class="card shadow mt-3">
            <div class="card-header">
                <h5>Registration Form</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="../config/submit_registration.php">
                    <!-- Add a hidden input field for webinar_id -->
                    <input type="hidden" name="webinar_id" value="<?php echo $webinar_id; ?>">
                    <div class="form-group">
                        <label for="name"><i class="fas fa-user"></i> Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email"><i class="fas fa-envelope"></i> Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="student-id"><i class="fas fa-id-card"></i> Student ID:</label>
                        <input type="text" class="form-control" id="student-id" name="student_id" required>
                    </div>
                    <div class="form-group">
                        <label for="school"><i class="fas fa-school"></i> School:</label>
                        <input type="text" class="form-control" id="school" name="school" required>
                    </div>
                    <div class="form-group">
                        <label for="organization"><i class="fas fa-building"></i> Organization:</label>
                        <input type="text" class="form-control" id="organization" name="organization" required>
                    </div>
                    <div class="form-group">
                        <label for="program"><i class="fas fa-book"></i> Program:</label>
                        <input type="text" class="form-control" id="program" name="program" required>
                    </div>
                    <div class="form-group">
                        <label for="position"><i class="fas fa-users"></i> Position:</label>
                        <input type="text" class="form-control" id="position" name="position" required>
                    </div>
                    <input type="hidden" name="webinar_id" value="<?php echo $webinar_id; ?>">
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary btn-block" name="register_btn"><i class="fas fa-paper-plane"></i> Register</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

    <?php
        include('../includes/footer.php');
    ?>
