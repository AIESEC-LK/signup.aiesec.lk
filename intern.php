<?php
// Extract the "ley" parameter from the URL

$ley = isset($_GET['ley']) ? strtolower($_GET['ley']) : '';

// Assign values based on the "ley" parameter
if ($ley === 'cc') {
    $dataId = '7667';
    $value = '222';
} elseif ($ley === 'cn') {
    $dataId = '7668';
    $value = '872';
} elseif ($ley === 'cs') {
    $dataId = '7669';
    $value = '1340';
} elseif ($ley === 'usj') {
    $dataId = '7670';
    $value = '221';
} elseif ($ley === 'kandy') {
    $dataId = '7671';
    $value = '2204';
} elseif ($ley === 'ruhuna') {
    $dataId = '7672';
    $value = '2175';
} elseif ($ley === 'sliit') {
    $dataId = '7673';
    $value = '2188';
} elseif ($ley === 'nsbm') {
    $dataId = '7674';
    $value = '2186';
} elseif ($ley === 'nibm') {
    $dataId = '14179';
    $value = '4535';
} elseif ($ley === 'apiit') {
    $dataId = '8723';
    $value = '222';
} elseif ($ley === 'iit') {
    $dataId = '7997';
    $value = '872';
} elseif ($ley === 'jaffna') {
    $dataId = '11136';
    $value = '2204';
} elseif ($ley === 'kdu') {
    $dataId = '10231';
    $value = '1340';
} elseif ($ley === 'rajarata') {
    $dataId = '13991';
    $value = '5490';
} elseif ($ley === 'wayamba') {
    $dataId = '13990';
    $value = '221';
} elseif ($ley === 'sltc') {
    $dataId = '13106';
    $value = '1340';
} elseif ($ley === 'saegis') {
    $dataId = '11570';
    $value = '221';
} elseif ($ley === 'uwu') {
    $dataId = '11119';
    $value = '872';
} elseif ($ley === 'vavuniya') {
    $dataId = '37260';
    $value = '2204';
} elseif ($ley === 'icbt') {
    $dataId = '8986';
    $value = '221';
} else {
    // Redirect to signup.aiesec.lk if "ley" parameter is not recognized
    header('Location: https://signup.aiesec.lk/intern-abroad');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Required meta tags-->
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MFQGDFB');</script>
<!-- End Google Tag Manager -->

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="AIESEC Global Talent Sign Up">

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- Title Page-->
    <title>Sign Up</title>
    <link rel="shortcut icon" type="image/png" href="Favicon.png"/>
    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">
<style>

 @media screen and (max-device-width: 1980px) 
  and (-webkit-min-device-pixel-ratio: 1) and (min-device-width: 1200px) {
img.responsive { max-width: 15%; }
}
@media screen and ( max-width: 480px ) {
img.responsive { width: 50%; }
}
    
</style>
    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MFQGDFB"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

    <div class="page-wrapper bg-gra-03 p-t-100 p-b-100 font-poppins" style="background: linear-gradient(to top right, #0CB9C1 0%, #0CB9C1 100%);">
        <center><img src="Aiesecwhiteblue.png" alt="Smiley face" class="responsive" onclick="window.location='https://www.aiesec.lk';" > </center><br><br>
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <center><h2 class="title"  style="color:#0CB9C1;"> Global Talent Sign Up</h2></center>
                    <form id='signup_form'  >
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input  type="hidden" name="product" value='8' >
                                    <label class="label">First Name</label>
                                    <input class="input--style-4" type="text" name="first_name" required >
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Last Name</label>
                                    <input class="input--style-4" type="text" name="last_name" required >
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            
                            
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Email</label>
                                    <input class="input--style-4" type="email" name="email" required >
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Password</label>
                                    <input class="input--style-4" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="8 characters minimum with atleast one Uppercase letter, one number and one special character" type="password" name="password" >
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Phone Number</label>
                                    <input class="input--style-4" type="tel" placeholder="07xxxxxxxx" name="phone" pattern="[0][0-9]{9}" required>
                                </div>
                            </div>
                            <div class="input-group col-2">
                                <label class="label">Study Level</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="education" value="" required >
                                    <option disabled="disabled" selected="selected" hidden>Choose option</option>
                                            <option value="Employed">Employed</option>
                                            <option value="Undergrad">Undergraduate</option>
                                            <option value="Freshgrad">Fresh graduate</option>
                                            
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                                
                            </div>
                            <div class="input-group col-2">
                                
                                <label class="label">How did you find us?</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="referral" required >
                                    <option disabled="disabled" selected="selected" value="" hidden>Choose option</option>
                                            <option value="Friend&Ofln">Friend</option>
                                            <option value="Booth&Ofln">Information booth</option>
                                            <option value="Classroom presentation&Ofln">Classroom presentation</option>                                        
                                            <option value="Event&Off">Event</option>
                                            <option value="Media (magazine, TV, newspaper or radio)&Ofln">Media (magazine, TV, newspaper or radio)</option>
                                            <option value="Other&Ofln">Other</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                                
                            </div>
                            <div class="input-group col-2">
                                
                                <label class="label">Education Background</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="subproduct" required >
                                    <option disabled="disabled" selected="selected" value="" hidden>Choose option</option>
                                            <option value="It">IT</option>
                                            <option value="Mkt">Marketing</option>
                                            <option value="Eng">Engineering</option> 
                                            <option value="Edu">Education</option>
                                            
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                                
                            </div>
                            
                            
                        </div>
                        <div class="input-group">
						<label class="label"></label>
					<div class="rs-select2 js-select-simple ">
						<input type="hidden" name="institute" id="institute" data-id="<?php echo $dataId; ?>" value="<?php echo $value;?>">
					</div>
                                <br>  <div class="row row-space" >
                                    <div class="input-group ">
                                        <input type="checkbox" class="checkmark input-icon"  required>
                                    <label class="label" style="padding-left: 40px;text-indent: -15px;padding-top: 5px;">I may be contacted via Phone or E-mail </label>
                                    
                                    </div>
                            </div>
                        </div>
              
                        <div class="g-recaptcha" data-sitekey="6LfddL4UAAAAAH5VDHI75ZzDmn3M6hIAiVyOf7gz"></div>
                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--gt" style="background: #0CB9C1;" name="submit" type="submit">Sign Up
                            
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br><br><br><br>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

<script>
$(function () {
        $('form').on('submit', function (e) {
            
           console.log(grecaptcha.getResponse());

          e.preventDefault();
            Swal.fire({
            title: "We are Signing you up!",
            onBeforeOpen: () => {
            Swal.enableLoading() }
            });
          $.ajax({
            type: 'post',
            url: 'offline_signup.php',  //use /sign-upform/signup.php on production
            
            data: $('form').serialize() + "&alignment=" + <?php echo $dataId; ?>,
            success: function (data) {
            
              var response = JSON.parse(data);
              
              if(response.type == 'error')
                {
                    console.log(response);
                    Swal.fire({
                        title: "This email is already signed up!",
                        text: "Time to apply to opportunities",
                        type: "info",
                        confirmButtonText: "Take me there"
                    }).then((result) => {
                      if (result.value) {
                        window.location.replace("https://aiesec.org");
                      }
                    });
                }else if(response.type == 'sucesss'){
                    console.log(data);
                    Swal.fire({
                        title: "Signed Up!",
                        text: "Great! check your mail",
                        type: "success",
                        confirmButtonText: "Cool"
                    });
                    document.getElementById("signup").reset(); 
                }
                else if (response.type == 'fail'){
                    
                    Swal.fire({
                        title: "Error occured!",
                        text: "There seems to be an error, Please check the details you entered and try again",
                        type: "error",
                        confirmButtonText: "Okay"
                    }).then((result) => {
                      if (result.value) {
                        window.location.replace("https://aiesec.org");
                      }
                    });
                    
                }
                
            }
          });

        });

      });


</script>


</html>
<!-- end document-->

