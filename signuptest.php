<?php

require_once('/home/aiesecl1/public_html/sign-upform/sendsms.php');


$firstname = $_POST['first_name'];
$lastname = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$referral = $_POST['referral'];
$temp = $_POST['institute'];
$lc =  (explode(",",$temp))[0];
$alignment =  (explode(",",$temp))[1];
$productid = 1;



//$captcha_success = post_captcha($_POST['captcha']);

    $captcha = $_POST['g-recaptcha-response'];
    $privatekey = "6LfddL4UAAAAAOPEYcGmekOu4StWaAvdS1vlzCX4";
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array(
        'secret' => $privatekey,
        'response' => $captcha,
        'remoteip' => $_SERVER['REMOTE_ADDR']
    );

    $curlConfig = array(
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => $data
    );

    $ch = curl_init();
    curl_setopt_array($ch, $curlConfig);
    $response = curl_exec($ch);
    curl_close($ch);

$jsonResponse = json_decode($response);

if ($jsonResponse->success === true) {
    create_ep($lastname, $firstname, $email ,$phone, $password, $referral , $lc, $alignment, $productid);
}
else {
    $output = json_encode(array('type' => 'fail', 'text' => "Capcha invalid"));
    die($output);
}


        


// display the results
//echo 'Your name is ' . $lastname .' ' . $firstname.' ' .$email.' ' .$phone.' ' .$password.' ' .$referral.' ' .$lc.' ' .$alignment;


function create_ep($lastname, $firstname, $email ,$phone, $password, $referral , $lc, $alignment,$productid ){

    $endpoint='https://auth.aiesec.org/users.json';
    $stage='https://auth-staging.aiesec.org/users.json';
    
    $data=array (
      'user' => 
      array (
        'first_name' => $firstname,
        'last_name' => $lastname,
        'email' => $email,
        'country_code' => '+94',
        'phone' => $phone,
        'password' => $password,
        'alignment_id' => $alignment,
        'lc' => $lc,
        'referral_type' => $referral,
        'allow_phone_communication' => 'true',
        'allow_email_communication' => 'true',
        'selected_programmes' => '['.$productid.']',
      ),
    );
  
    $json_string = json_encode($data);
    $slack_call = curl_init($endpoint);
    curl_setopt($slack_call, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($slack_call, CURLOPT_POSTFIELDS, $json_string);
    curl_setopt($slack_call, CURLOPT_CRLF, true);
    curl_setopt($slack_call, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($slack_call, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "Content-Length: " . strlen($json_string))
    );
    
    
    $result = curl_exec($slack_call);
    
    if (curl_errno($slack_call)) {
        
        $error_msg = curl_error($slack_call);
        $output = json_encode(array('type' => 'fail', 'text' => 'error occured : '.$error_msg));
        post_slack_error($error_msg);
        die($output);
    }
    curl_close($slack_call);
    
    if (response_check($result)==true) {
        
        $message="Congratulations ".$firstname.". Thank you for signing up with AIESEC to develop yourself. Please visit https://auth.aiesec.org/users/sign_in?country=Sri+Lanka to login and complete your profile and apply for our exchange programs"; //sms message body
        //send_sms($message,$firstname,$lastname,$email,$phone,$productid);
        $output = json_encode(array('type' => 'sucesss', 'text' => 'signup'));
        post_slack($productid);
        post_lb_slack($productid,$lc);
        die($output);
    }
    else{
        $output = json_encode(array('type' => 'error', 'text' => 'email taken'));
        die($output);
    
    }
    
    

  }
  
function response_check($response){
     $email_taken=json_encode(array (
      'errors' => 
      array (
        'email' => 
        array (
          0 => 'has already been taken',
        ),
      ),
    ));
    if ($response==$email_taken) {
     
        return false;
   
    }
    else {
        
        return true;
    }
}



function post_slack($id)
{
    if ($id=='1'){
        $prodcut='OGV';
    }
    else if($id=='5'){
        $prodcut='OGE';
    }
    else if($id=='2'){
        $prodcut='OGT';
    }
    
    $data = array (
        'text' => 'Hello there, There is a new '.$prodcut .' lead');

    $slack_webhook_url='https://hooks.slack.com/services/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';
    $json_string = json_encode($data);
    $slack_call = curl_init($slack_webhook_url);
    curl_setopt($slack_call, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($slack_call, CURLOPT_POSTFIELDS, $json_string);
    curl_setopt($slack_call, CURLOPT_CRLF, true);
    curl_setopt($slack_call, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($slack_call, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "Content-Length: " . strlen($json_string))
    );
    
    $result = curl_exec($slack_call);
    curl_close($slack_call);   

}




function post_slack_error($id)
{
    
    $data = array (
        'text' => 'API fail with error '.$id,
    );

    $slack_webhook_url='https://hooks.slack.com/services/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';
    $json_string = json_encode($data);
    $slack_call = curl_init($slack_webhook_url);
    curl_setopt($slack_call, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($slack_call, CURLOPT_POSTFIELDS, $json_string);
    curl_setopt($slack_call, CURLOPT_CRLF, true);
    curl_setopt($slack_call, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($slack_call, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "Content-Length: " . strlen($json_string))
    );
    
    $result = curl_exec($slack_call);
    curl_close($slack_call);   

}


function post_lb_slack($id,$lc_code)
{
    if ($id=='1'){
        $prodcut='OGV';
    }
    else if($id=='5'){
        $prodcut='OGE';
    }
    else if($id=='2'){
        $prodcut='OGT';
    }
    
    $data = array (
        'text' => 'Hello there, There is a new '.$prodcut .' Signup');

    if ($lc_code='222') {
      $slack_webhook_url='https://hooks.slack.com/services/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'; #CC
    }
    elseif ($lc_code='872') {
      $slack_webhook_url='https://hooks.slack.com/services/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'; #CN
    }
    elseif ($lc_code='2188') {
      $slack_webhook_url='https://hooks.slack.com/services/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'; #SLIIT
    }
    else{
        return;
    }
    
    $json_string = json_encode($data);
    $slack_call = curl_init($slack_webhook_url);
    curl_setopt($slack_call, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($slack_call, CURLOPT_POSTFIELDS, $json_string);
    curl_setopt($slack_call, CURLOPT_CRLF, true);
    curl_setopt($slack_call, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($slack_call, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "Content-Length: " . strlen($json_string))
    );
    
    $result = curl_exec($slack_call);
    curl_close($slack_call);   

}


function post_captcha($user_response) {
        $fields_string = '';
        $fields = array(
            'secret' => '6Le3cL4UAAAAAJWr0WhESQMkPPE_Om6TF0SsuR2t',
            'response' => $user_response
        );
        foreach($fields as $key=>$value)
        $fields_string .= $key . '=' . $value . '&';
        $fields_string = rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }



?>