<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>try</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
    
    <!-- Include Owl Carousel CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/owl.theme.default.min.css">

    <style>
        /* Custom CSS styles for carousel items */
        .owl-carousel .owl-item {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            border-radius: 4px;
            height: 100px; /* Adjust the height as desired */
            width: 100px; /* Adjust the width as desired */
            margin: 0 auto;
        }

        /* Custom CSS styles for the content within carousel items */
        .owl-carousel .owl-item h3 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="owl-carousel">
            <div><h3>1</h3></div>
            <div><h3>2</h3></div>
            <div><h3>3</h3></div>
            <div><h3>4</h3></div>
            <div><h3>5</h3></div>
            <div><h3>6</h3></div>
        </div>
    </div>
    

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Owl Carousel JS -->
    <script src="../assets/js/owl.carousel.min.js"></script>

    <script>
    $(document).ready(function() {
        $('.owl-carousel').owlCarousel({
            // Add your desired options here
            items: 1,
            loop: true,
            dots: true,
            center: true
        });
    });
    </script>
</body>
</html>
