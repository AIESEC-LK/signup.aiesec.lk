<?php

require_once('/home/aiesecl1/public_html/sign-upform/sendsms.php');

$firstname = ucfirst($_POST['first_name']);
$lastname = ucfirst($_POST['last_name']);
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$referral = $_POST['referral'];
#$temp = $_POST['institute'];
$lc = $_POST['institute'];
$alignment = $_POST['alignment'];
$productid = intval($_POST[product]);
$group=0;
if ($productid==7){
    $group='1605';
}
elseif($productid==8){
    $group='1606';
}
elseif($productid==9){
    $group='1607';
}
// display the results
//echo 'Your name is ' . $lastname .' ' . $firstname.' ' .$email.' ' .$phone.' ' .$password.' ' .$referral.' ' .$lc.' ' .$alignment;


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
    create_ep($lastname, $firstname, $email ,$phone, $password, $referral , $lc, $alignment, $productid,$group);
}
else {
    $output = json_encode(array('type' => 'fail', 'text' => "Capcha invalid"));
    die($output);
}



//create_ep($lastname, $firstname, $email ,$phone, $password, $referral , $lc, $alignment, $productid,$group); 


function create_ep($lastname, $firstname, $email ,$phone, $password, $referral , $lc, $alignment,$productid,$group ){

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
        'referral_type' => $referral.'&Web',
        'allow_phone_communication' => 'true',
        'allow_email_communication' => 'true',
        'selected_programmes' => [$productid],
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
        
        $message="Congratulations ".$firstname.", You have successfully signed up with AIESEC to develop yourself and explore your potential. Please login at https://www.aiesec.lk/login on our opportunity portal to complete your profile and your experience manager will contact you"; //sms message body
        $smsresponse=send_sms($message,$firstname,$lastname,$email,$phone,$group);
        $result_decode=json_decode($result, true);
        $output = json_encode(array('type' => 'sucesss', 'text' => $result));
        post_slack($productid,$firstname,$result_decode['person_id'],$referral);
        post_lb_slack($productid,$lc,$firstname,$result_decode['person_id'],$referral);
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

function create_error_message($response=''){

    $email_taken=json_encode(array (
        'errors' => 
        array (
          'email' => 
          array (
            0 => 'has already been taken',
          ),
        ),
      ));

    $error = json_decode($email_taken, true);
    print_r($error);        // Dump all data of the Array
    
    foreach ($error as $key => $value1) {
        foreach ($value1 as $key => $value) {
            echo $key . $value;
          }
      }

}



function post_slack($id,$firstname,$epid,$referral)
{
    if ($id=='7'){
        $prodcut='oGV';
    }
    else if($id=='9'){
        $prodcut='oGTe';
    }
    else if($id=='8'){
        $prodcut='oGTa';
    }
    
    $data = array (
        'text' => 'Hello there, There is a new '.$prodcut.' lead => '.$firstname.' | EP ID => '.$epid.' | From => ' .$referral );

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


function post_lb_slack($id,$lc_code,$firstname,$lastname,$referral)
{
    if ($id=='7'){
        $prodcut='oGV';
    }
    else if($id=='9'){
        $prodcut='oGTe';
    }
    else if($id=='8'){
        $prodcut='oGTa';
    }
    
    $data = array (
        'text' => 'Hello there, There is a new '.$prodcut.' Signup => '.$firstname.' | EP ID => '.$lastname.' | From => ' .$referral );

    if ($lc_code =='222') {
      $slack_webhook_url='https://hooks.slack.com/services/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'; #CC
    }
    elseif ($lc_code =='872') {
      $slack_webhook_url='https://hooks.slack.com/services/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'; #CN
    }
    elseif ($lc_code =='2188') {
      $slack_webhook_url='https://hooks.slack.com/services/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'; #SLIIT
    }
    elseif ($lc_code == '2204'){
        $slack_webhook_url='https://hooks.slack.com/services/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'; #kandy
    }
    elseif ($lc_code == '1340'){
        $slack_webhook_url='https://hooks.slack.com/services/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'; #cs
    }
    else if ($lc_code == '2186') {
        $slack_webhook_url = "https://hooks.slack.com/services/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"; #nsbm
     
    }
    else if ($lc_code == '221') {
        $slack_webhook_url = "https://hooks.slack.com/services/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"; #jlc
     
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



?>