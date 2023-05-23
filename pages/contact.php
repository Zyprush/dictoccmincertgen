<?php include('../includes/header-2.0.php'); 

$receiver_email = "alberiojake27@gmail.com";
?>

<div class="container">
  <div class="row">
    <div class="col-lg-8 offset-lg-2">
      <h1 class="mt-5">Contact Us</h1>
      <p>Feel free to reach out to us with any questions or inquiries.</p>
      
      <h2 class="mt-5">Contact Information</h2>
      <p><i class="fas fa-map-marker-alt"></i> Brgy. Payompon, Mamburao 5106, Occidental Mindoro</p>
      <p><i class="fas fa-envelope"></i> <?php echo $receiver_email; ?></p>
      <p><i class="fas fa-phone"></i> 043 773 0275</p>
      
      <h2 class="mt-5">Contact Form</h2>

      <form method="POST" action="../config/contact.php">

        <!-- Add the email receiver as a hidden field -->
        <input type="hidden" name="receiver_email" value='<?php echo $receiver_email; ?>'>

        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="sender_email" name="sender_email" placeholder="Enter your email">
        </div>
        <div class="form-group">
          <label for="message">Message</label>
          <textarea class="form-control" id="message" name="message" rows="5" placeholder="Enter your message"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Message</button>
      </form>
    </div>
  </div>
</div>

<?php include('../includes/footer.php'); ?>