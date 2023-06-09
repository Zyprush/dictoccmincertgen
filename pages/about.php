<?php include('../includes/header-2.0.php'); ?>

<div class="container">
  <div class="row">
    <div class="col-lg-8 offset-lg-2">
      <h1 class="mt-5"><i class="fas fa-cogs fa-lg"></i>About Us</h1>
      <p class="lead">Welcome to our dynamic website!</p>
      <p>
      <i class="fas fa-shield-alt fa-lg"></i> We are the official platform of the Department of Information and Communications Technology (DICT), dedicated to providing an innovative solution for all your certificate needs. With our cutting-edge certificate generator, sending email certificates, and efficient webinar management, we offer a seamless experience that combines convenience and creativity. Whether you're commemorating achievements or facilitating professional growth, our platform empowers you to effortlessly create, distribute, and manage certificates with utmost ease. Join us on this exciting journey as we revolutionize the way you recognize accomplishments and harness the power of technology in the world of certificates.
      </p>
      
      <h2 class="mt-5"><i class="fas fa-code fa-lg"></i> Our Developer</h2>
      <p class="lead">Meet our Developer!</p>
      <p>
        <i class="fas fa-user fa-lg"></i> The website was developed by
        <b><a href="mailto:alberiojake27@gmail.com" class="contact-link" data-toggle="popover" data-placement="top" data-content="alberiojake27@gmail.com">Jake Denver Alberio</a></b>
        and
        <b><a href="mailto:hanzbausa123@gmail.com" class="contact-link" data-toggle="popover" data-placement="top" data-content="hanzbausa123@gmail.com">Hanz Bausa</a></b>,
        skilled web developers passionate about creating user-friendly and visually appealing websites.
      </p>
      
    </div>
  </div>
</div>


<!-- Add this JavaScript code to initialize the Bootstrap popover -->
<script>
  // Initialize Bootstrap popover
  $(function () {
    $('.contact-link').popover({
      trigger: 'hover',
    });
  });
</script>
<?php include('../includes/footer.php'); ?>