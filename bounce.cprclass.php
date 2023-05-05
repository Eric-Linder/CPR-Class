<?php 
  include('./Includes/header.php');
   ?>
<?php 
   // include('./Includes/nav.php');
?>

<div class="container minheight">
   <div class="row">
      <div class="container newsletter_container">
         <div class="col-md-6 offset-md-3">
                <table class="table">
                <?php
                if(isset($_POST['submit']))
                    {
                        $fname = isset($_POST['fname']) ? $_POST['fname'] : null;
                       // print("<tr><td>fname: </td><td>$fname</td></tr>");

                        $middle = isset($_POST['middle']) ? $_POST['middle'] : null;
                       // print("<tr><td>middle: </td><td>$middle</td></tr>");

                        $lname = isset($_POST['lname']) ? $_POST['lname'] : null;
                       // print("<tr><td>lname: </td><td>$lname</td></tr>");

                        $clientemail = isset($_POST['clientemail']) ? $_POST['clientemail'] : null;
                      //  print("<tr><td>clientemail: </td><td>$clientemail</td></tr>");

                        $clientphone = isset($_POST['clientphone']) ? $_POST['clientphone'] : null;
                      //  print("<tr><td>clientphone: </td><td>$clientphone</td></tr>");

                        $inputStreet = isset($_POST['inputStreet']) ? $_POST['inputStreet'] : null;
                      //  print("<tr><td>inputStreet: </td><td>$inputStreet</td></tr>");

                        $inputState = isset($_POST['inputState']) ? $_POST['inputState'] : null;
                       // print("<tr><td>inputState: </td><td>$inputState</td></tr>");

                        $inputZip = isset($_POST['inputZip']) ? $_POST['inputZip'] : null;
                      //  print("<tr><td>inputZip: </td><td>$inputZip</td></tr>");

                        $inputAptNo = isset($_POST['inputAptNo']) ? $_POST['inputAptNo'] : null;
                      //  print("<tr><td>inputAptNo: </td><td>$inputAptNo</td></tr>"); 
        
                         $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : null;
                      //  print("<tr><td>birthdate: </td><td>$birthdate</td></tr>");  

                         $choose_session = isset($_POST['choose_session']) ? $_POST['choose_session'] : null;
                      //  print("<tr><td>choose_session: </td><td>$choose_session</td></tr>"); 

                    }
                ?>
                </table>
         </div>

        
            <?php
                include('./Config/config.php');
            ?>
    
            <?php
                $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname","$dbusername","$dbpassword");
$stmt = $dbh->prepare("INSERT INTO `cprclass` (`id`, `fname`, `middle`, `lname`, `clientemail`, `clientphone`, `inputStreet`, `inputState`, `inputZip`, `inputAptNo`, `birthdate`, `session`, `timestamp`) VALUES (NULL,  :FIRSTNAME, :MIDDLENAME, :LASTNAME, :USEREMAIL, :USERPHONE, :USERSTREET, :USERSTATE, :USERZIP, :USERAPTNO, :USERSBIRTHDATE, :USERSESSION, current_timestamp())");

                    $stmt->bindParam(':FIRSTNAME', $fname, PDO::PARAM_STR,20);
                    $stmt->bindParam(':MIDDLENAME', $middle, PDO::PARAM_STR,20);
                    $stmt->bindParam(':LASTNAME', $lname, PDO::PARAM_STR,20);
                    $stmt->bindParam(':USEREMAIL', $clientemail, PDO::PARAM_STR,30);
                    $stmt->bindParam(':USERPHONE', $clientphone, PDO::PARAM_STR,20);
                    $stmt->bindParam(':USERSTREET', $inputStreet, PDO::PARAM_STR,50);
                    $stmt->bindParam(':USERSTATE', $inputState, PDO::PARAM_STR,20);
                    $stmt->bindParam(':USERZIP', $inputZip, PDO::PARAM_STR,20);
                    $stmt->bindParam(':USERAPTNO', $inputAptNo, PDO::PARAM_STR,20);
                    $stmt->bindParam(':USERSBIRTHDATE', $birthdate, PDO::PARAM_STR,30);
                    $stmt->bindParam(':USERSESSION', $choose_session, PDO::PARAM_STR,20);
                    $stmt->execute();
                    $lastid = $dbh->lastInsertId();
                    if($lastid){
                       // print('<p>Last ID'.$lastid.'</p>');
                    $lastrow = (int)$lastid;
                    $stmt = $dbh->prepare("UPDATE `cprclass` SET `confirmation` = (SELECT UUID_SHORT()) WHERE `cprclass`.`id` = ".$lastrow."");
                    $stmt->execute();
                    $query = $dbh->prepare("SELECT * FROM `cprclass` WHERE id=$lastrow");
                    $query->execute();
                    $confirmaton = $query->fetch(PDO::FETCH_ASSOC);
                    //print_r($confirmaton);

                    $shortconfirm = substr($confirmaton['confirmation'],10);

                    print('<div class="jumbotron" id="jumsuccess"><h1 class="display-4">SUCCESS!</h1>');
                    print('<p class="lead">You have successfully registered for May 21</p>');
                    print('<p class="lead">CPR Class</p>');
                    print('<hr class="my-4">');
                    print('<p>Confirmation Number <br/>#'.substr($confirmaton['confirmation'],10).'</p>');
                    print('<p>Date: May 21, 2023. <br/>Session: '.$confirmaton['session'].'.</p>');
                    print('<p>Flatbush Park Jewish Center <br/>6363 Avenue U, Brooklyn, NY 11234 <br/>The Ulam Room</p>');
                    // print('<br/><p class="lead"><a class="btn btn-primary btn-lg" href="./index.php" role="button">Home Page</a></p>');
                    print('<br/><p class="lead"><a class="btn btn-warning btn-lg" href="https://hatzolahofmillbasin.org/donate/" role="button" target="_blank">DONATE NOW</a></p>');
                    print('</div>');

                    /*888888888888888888888888888888888888888888888888*/
                    require_once('../vendor/autoload.php');
                    // $brevo_mail_key - this variable is in /Config
                    $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', $brevo_mail_key);
                    $apiInstance = new SendinBlue\Client\Api\TransactionalEmailsApi(
                        new GuzzleHttp\Client(),
                        $config
                    );
                    $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail();
                    $sendSmtpEmail['subject'] = '{{params.subject}}';
                    $sendSmtpEmail['htmlContent'] = '
                    <html>
                      <body>
                        <h3>{{params.parameter}}</h3>
                        <p>Hi, '.$fname.' '.$lname.'</p>
                        <p>Hatzolah Mill Basin welcomes you to free CPR Training.
                        <p>Your Training Starts: '.$choose_session.'</p>
                        <p>Your Registration Number <strong>'.$shortconfirm.'</strong></p>
                        <p>Date: May 21, 2023</p>
                        <p>Flatbush Park Jewish Center<br/>
                           6363 Avenue U, Brooklyn, NY 11234<br/>
                           The Ulam Room</p>
                           <p>Your CPR card will be issued via email upon completion of the training course.</p>
                      </body>
                    </html>';
                    $sendSmtpEmail['sender'] = array('name' => 'Hatzolah Mill Basin', 'email' => 'info@hatzolahofmillbasin.org');
                    // $sendSmtpEmail['sender'] = array('name' => 'Smart Medical Solutions', 'email' => 'elinder@smartmedsolutions.com');
                    $sendSmtpEmail['to'] = array(
                        // array('email' => 'leif@leiflinder.com', 'name' => 'Jane Doe')
                        array('email' => $clientemail, 'name' => $fname)
                    );
                    // $sendSmtpEmail['cc'] = array(
                    //     array('email' => 'leif@lindercreative.com', 'name' => 'Janice Doe')
                    // );
                    // $sendSmtpEmail['bcc'] = array(
                    //     array('email' => 'elinder@smartmedsolutions.com', 'name' => 'John Doe')
                    // );
                     $sendSmtpEmail['replyTo'] = array('email' => 'info@hatzolahofmillbasin.org', 'name' => 'Hatzolah Mill Basin');
                    // $sendSmtpEmail['replyTo'] = array('email' => 'elinder@smartmedsolutions.com', 'name' => 'Smart Medical Solutions');
                    $sendSmtpEmail['headers'] = array('Some-Custom-Name' => 'unique-id-1234');
                    $sendSmtpEmail['params'] = array('parameter' => 'Hatzolah Mill CPR Training', 'subject' => 'CPR Registration');

                    try {
                        $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
                        // print('<pre>');
                        // print_r($result);
                        // print('</pre>');
                    } catch (Exception $e) {
                        echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
                    }
                    /*888888888888888888888888888888888888888888888888*/


                    
                    }else{
                        print('<p>There was a problem</p>');
                    }
            ?>
      </div>
   </div>
</div>
<?php // include('./Includes/footer.php'); ?>