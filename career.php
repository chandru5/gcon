<?php 
    ini_set( 'display_errors', 0);
    // error_reporting( E_ALL );
    include('database.php');
    if(isset($_REQUEST['action']) && $_REQUEST['action']=='save') {
        $returnArray = [];
        $from = $_REQUEST['email_address'];
        $to = "chanspartan@gmail.com";
        $subject = "New user registered for career";
        $message = "Please find the attached details";
        $headers = "From:" . $from;
        $name = date('ydms').basename($_FILES["resume"]["name"]);

         //read from the uploaded file & base64_encode content
        $size       =  $_FILES['resume']['size'];
        $handle     = fopen($_FILES['resume']['tmp_name'], "r"); // set the file handle only for reading the file
        $content    = fread($handle, $size); // reading the file
        fclose($handle);                 // close upon completion
    
        $encoded_content = chunk_split(base64_encode($content));
        
        $boundary = md5("random"); // define boundary with a md5 hashed 

        //plain text
        $body = "--$boundary\r\n";
        $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $body .= chunk_split(base64_encode($message));
            
        //attachment
        $body .= "--$boundary\r\n";
        $body .="Content-Type: $type; name=".$name."\r\n";
        $body .="Content-Disposition: attachment; filename=".$name."\r\n";
        $body .="Content-Transfer-Encoding: base64\r\n";
        $body .="X-Attachment-Id: ".rand(1000, 99999)."\r\n\r\n";
        $body .= $encoded_content; // Attaching the encoded file with email
        
        if(move_uploaded_file($_FILES['resume']['tmp_name'], './upload/'.$name)) {

            $data = [
                [$_REQUEST['firstName'], $_REQUEST['phone'], $_REQUEST['email_address'], $name]
            ];
            $stmt = $conn->prepare("INSERT INTO register (name, phone, email, resume) VALUES (?,?,?,?)");
            try {
                $conn->beginTransaction();
                foreach ($data as $row)
                {
                    $stmt->execute($row);
                }
                $conn->commit();
                $returnArray['db'] = 'Record added successfully.';
                $returnArray['status'] = 'success';
                if(mail($to,$subject,$message, $headers)) {
                    $returnArray['msg'] = 'Your registration is done';
                } else {
                    $returnArray['msg'] = 'Failed to send your req, try again!';
                }
            }catch (Exception $e){
                $conn->rollback();
                $returnArray['status'] = 'error';
                $returnArray['msg'] = $e->getMessage();
            }
        } else {
            $returnArray['status'] = 'error';
            $returnArray['msg'] = 'Something went wrong, try again!';
        }
        echo json_encode($returnArray);
        exit;
    }
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Gcon Engineers - Projects</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon-gcon.png">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/gijgo.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <style>
    .project-img img {
        height: 330px;
    }

    .error {
        color: red;
    }
    </style>
</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/gcon-logo.png" style="width:160px;" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <?php include('header.php'); ?>

    <main>
        <!-- slider Area Start-->
        <div class="slider-area ">
            <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
                data-background="assets/img/banner-career.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap pt-100">
                                <h2>Career</h2>
                                <nav aria-label="breadcrumb ">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                        <li class="breadcrumb-item"><a href="#">Project</a></li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- slider Area End-->
        <div class="container">
            <div class="row pt-5 pb-3 mt-2">
                <div class="col-12">
                    <p class="submit-error text-danger" style="display: none;">Something went wrong,
                        try again!</p>
                    <p class="submit-success text-success" style="display: none;">Thank you for the
                        registration.
                    </p>
                    <form method="post" action="javascript:void(0);" id="career_submit" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Name</label>
                                <input type="text" class="form-control" id="inputPassword4" name="firstName"
                                    placeholder="Your name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Email</label>
                                <input type="email" class="form-control" id="inputEmail4" name="email_address"
                                    placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Phone</label>
                            <input type="text" class="form-control" id="inputAddress" name="phone"
                                placeholder="Eg: 987654321">
                        </div>
                        <div class="form-group">
                            <label for="resume">Resume/CV</label>
                            <input type="file" class="form-control" name="resume" id="resume"
                                accept="application/msword, .doc,.docx, application/pdf">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include('footer.php'); ?>

    <!-- JS here -->

    <!-- All JS Custom Plugins Link Here here -->
    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <!-- Date Picker -->
    <script src="./assets/js/gijgo.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>

    <!-- Scrollup, nice-select, sticky -->
    <script src="./assets/js/jquery.scrollUp.min.js"></script>
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>

    <!-- counter , waypoint -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
    <script src="./assets/js/jquery.counterup.min.js"></script>

    <!-- contact js -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/additional-methods-validate.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#preloader-active').show();
        $("#career_submit").validate({
            ignore: [],
            rules: {
                firstName: "required",
                phone: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10
                },
                email_address: {
                    required: true,
                    email: true
                },
                resume: {
                    required: true
                }
            },
            messages: {
                firstName: "Please enter your name",
                phone: {
                    required: "Please provide Mobile number",
                    number: "Number only allowed",
                },
                resume: {
                    required: 'Upload your resume'
                },
                email_address: "Please enter a valid email address",
            },
            submitHandler: function(form) {
                var file_data = $('#resume').prop('files')[0];   
                var form_data = new FormData(form);                  
                form_data.append('file', file_data);
                $.ajax({
                    url: 'career.php?action=save',
                    type: form.method,
                    data: form_data,
                    mimeType: "multipart/form-data",
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#preloader-active').show();
                    },
                    complete: function() {
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                        $('#preloader-active').hide();
                        resetForm();
                    },
                    success: function(res) {
                        $('.submit-error').hide();
                        $('.submit-success').hide();
                        res = $.parseJSON(res);
                        if (res.status == 'success') {
                            $('.submit-success').show();
                        } else {
                            $('.submit-error').html(res.message).show();
                        }
                    },
                    error: function() {
                        $('.submit-error').show();
                        resetForm();
                    }
                });
            }
        });

        function resetForm() {
            $('#career_submit').trigger("reset");
        }
        resetForm(); /* To reset everything*/
    });
    </script>

</body>

</html>