<?php

$recipients = 'raul@wheretogo.com.mx';
//var_dump($_POST);
//$recipients = '#';

try {
    require './phpmailer/PHPMailerAutoload.php';

    preg_match_all("/([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)/", $recipients, $addresses, PREG_OFFSET_CAPTURE);

    if (!count($addresses[0])) {
        die('MF001');
    }

    if (preg_match('/^(127\.|192\.168\.)/', $_SERVER['REMOTE_ADDR'])) {
        die('MF002');
    }

    $template = file_get_contents('rd-mailform.tpl');
    
    if (isset($_POST['form-type'])) {
        switch ($_POST['form-type']){
            case 'contact':
                $subject = 'A message from your site visitor';
                break;
            case 'subscribe':
                $subject = 'Subscribe request';
                break;
            case 'order':
                $subject = 'Order request';
                break;
            default:
                $subject = 'A message from your site visitor';
                break;
        }
    }else{
        die('MF004');
    }

    if (isset($_POST['email'])) {
        //$template = str_replace(["<!-- #{FromState} -->", "<!-- #{FromEmail} -->"], ["Email:", $_POST['email']], $template);
        $template = str_replace("<!-- #{FromState} -->", "Email:", $template);
        $template = str_replace("<!-- #{FromEmail} -->", $_POST['email'], $template);
    }else{
        die('MF003');
    }
    

    if (isset($_POST['message'])) {
        //$template = str_replace(["<!-- #{MessageState} -->", "<!-- #{MessageDescription} -->"], ["Message:", $_POST['message']], $template);
        $template = str_replace("<!-- #{MessageState} -->", "Message:", $template);
        $template = str_replace("<!-- #{MessageDescription} -->", $_POST['message'], $template);
    }
    

    preg_match("/(<!-- #{BeginInfo} -->)(.|\n)+(<!-- #{EndInfo} -->)/", $template, $tmp, PREG_OFFSET_CAPTURE);
    foreach ($_POST as $key => $value) {
        if ($key != "email" && $key != "message" && $key != "form-type" && !empty($value)){
            //$info = str_replace(["<!-- #{BeginInfo} -->", "<!-- #{InfoState} -->", "<!-- #{InfoDescription} -->"], ["", ucfirst($key) . ':', $value], $tmp[0][0]);
            $info = str_replace("<!-- #{BeginInfo} -->", "", $tmp[0][0]);
            $info = str_replace("<!-- #{InfoState} -->", ucfirst($key) . ':', $tmp[0][0]);
            $info = str_replace("<!-- #{InfoDescription} -->", $value, $tmp[0][0]);

            $template = str_replace("<!-- #{EndInfo} -->", $info, $template);
        }
    }


    //$template = str_replace(["<!-- #{Subject} -->", "<!-- #{SiteName} -->"], [$subject, $_SERVER['SERVER_NAME']], $template);
    $template = str_replace("<!-- #{Subject} -->", $subject, $template);
    $template = str_replace("<!-- #{SiteName} -->", $_SERVER['SERVER_NAME'], $template);
    
    $mail = new PHPMailer();
    $mail->From = $_SERVER['SERVER_ADDR'];
    $mail->FromName = $_SERVER['SERVER_NAME'];
    
    
    $mail->From = "info@iconoplaya.com";
    $mail->FromName = "Icono Playa";
    /*$mail->addBCC('raul@wheretogo.com.mx');*/
    $mail->addBCC('oliver@wheretogo.com.mx');

    $mail->addBCC('raul@wheretogo.com.mx');
    $mail->addBCC('a.acosta@iconoplaya.com');
    $mail->addBCC('c.arceyut@iconoplaya.com');
    foreach ($addresses[0] as $key => $value) {
        $mail->addAddress($value[0]);
    }

    $mail->CharSet = 'utf-8';
    $mail->Subject = $subject;
    $mail->MsgHTML($template);

    if (isset($_FILES['attachment'])) {
        foreach ($_FILES['attachment']['error'] as $key => $error) {
            if ($error == UPLOAD_ERR_OK) {
                $mail->AddAttachment($_FILES['attachment']['tmp_name'][$key], $_FILES['Attachment']['name'][$key]);
            }
        }
    }

    $mail->send();

    die('MF000');
    
} catch (phpmailerException $e) {
    die('MF254');
} catch (Exception $e) {
    die('MF255');
}

?>