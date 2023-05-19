<!DOCTYPE html>
<html>
<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
    <title>Sign in</title>
    
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #0074e1;
            overflow: hidden;
        }
        
        .blue-section {
            display: flex;
            flex-direction: column;
            justify-content: top;
            align-items: center;
            width: 50%;
            height: 100vh;
            background-color: #0074e1;
            float: left;
            margin-top: 50px;   
        }
        
        .white-section {
            width: 50%;
            height: 100vh;
            background-color: white;
            float: left;
            border-radius: 100% 0 50% 50%;
        }
        
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        
        .custom-header {
            background-color: #white;
            color: white;
            height: 65px;
        }
        .custom-footer {
            background-color: #0074e1;
            height: 40px;
            color: white;
        }
        .card {
            width: 43%;
            border-radius: 20px 20px 20px 20px ;
        }

        .logo-container {
            display: grid;
            grid-template-columns: auto 1fr;
            grid-gap: 10px;
            align-items: center;
        }

        .logo-container img {
            width: 200px; /* Set the desired width for the logo */
        }
        .logo img {
            max-width: 100%;
        }

        .text-white {
            color: white;
            font-family: Helvetica, sans-serif;
            font-size: 30px;
            margin-left: 20px;
            margin-top: 5px;
        }

        .custom-color {
            background-color: #f79e02;
            border-color: #f79e02;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .custom-color:hover {
            background-color: #ffbf40;
            border-color: #ffbf40;
        }

        .custom-card {
            background-color: #0074e1;
        }
        .text-header {
            font-size: 30px;
            font-family: Arial, sans-serif;
        }
        .text-container {
            display: flex;
            flex-direction: column;
        }
        .text-title {
            margin-top: 130px;
            font-size: 60px;
            font-family: Arial, sans-serif;
            color: white;
        }
        .text-subtitle {
            font-size: 20px;
            font-family: Arial, sans-serif;
            color: white;
            margin-left: 50px;
        }
    </style>
    
</head>
<body>

    <div class="blue-section">
        <div class="logo-container">
            <div class="logo">
                <img src="../assets/img/logo.png" alt="Logo">
            </div>
            <div class="text-container">
                <p class="text-white">DEPARTMENT OF INFORMATION AND <BR> COMMUNICATIONS TECHNOLOGY</p>
            </div>
        </div>
        <p class="text-title">Webinar Certificates Automation</p>
        <p class="text-subtitle">
        Webinar Certificates Automation simplifies the process of managing webinars by automating key tasks. Generate professional PDF certificates, send automated emails to participants, and gain valuable insights into attendance and engagement. With this innovative platform, you can focus on delivering exceptional webinar experiences while streamlining administrative processes. Elevate your webinars to new heights with Webinar Certificates Automation.
        </p>
    </div>


    <div class="white-section">
        <div class="container my-5">
            <div class="card mx-auto custom-card">
                <?php
                    if(isset($_SESSION['status'])){
                        echo "<h5 class='alert alert-success'>".($_SESSION['status'])."</h5>";
                        unset($_SESSION['status']);
                    }
                ?>
                <div class="card-header custom-header">
                    <h1 class="text-header text-center my-0">Sign In</h1>
                </div>
                <div class="card-body">
                    
                <form action="../config/logincode.php" method="POST">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="form-group">    
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block custom-color" name="signin_btn">Sign In</button>
                </form>

                </div>
            </div>
        </div>
    </div>
</body>
</html>
