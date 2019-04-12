<html>
   <head>
      <title>Sending HTML email using PHP</title>
   </head>
   
   <body>
      
      <?php
         $to = "receiver1@gmail.com";
         $subject = "This is subject";
         
         $message = "<b>This is HTML message.</b>";
         $message .= "<pre>This is headline.</1>";
         
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
