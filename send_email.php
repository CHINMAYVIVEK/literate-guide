<html>
   <head>
      <title>Sending HTML email using PHP</title>
   </head>
   
   <body>
      
      <?php
         $to = "receiver1@gmail.com";
         $subject = "This is subject";
         
         $link = "www.github.com/CHINMAYVIVEK/literate-guide/blob/PHP-PDO/send_email.php/";
         
         $message = "<b>This is email sending code.</b>";
         $message .= "<a href=".$link.">get the code</a>";
         
         $header = "From:sender1@gmail.com \r\n";
         $header .= "Cc:receiver2@gmail.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "Message sent successfully...";
         }else {
            echo "Message could not be sent...";
         }
      ?>
      
   </body>
</html>
