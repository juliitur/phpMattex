<?php

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $lastname = $_POST['lastname'];
  $mailfrom = $_POST['email'];
  $subject = $_POST['subject'];
  $phone = $_POST['phone'];
  $message = $_POST['message'];

// Send to:
  $mailto = "4d696368656c65@gmail.com";
  $headers = "From: ".$mailfrom;
  $subject = "Mattex Contact Form: " .$subject;
  $txt = "Name ".$name. "" .$lastname.". \n\n" .$message. "\n\n" . "Contact Phone Number: " . $phone;

  mail($mailto, $subject, $txt, $headers);

}
  header("Location: index.php?");

/* Using SendMail:
1- edit ssmtp.conf and configure etc/host
2- /etc/mail/sendmail.conf
3- edit ssmtp.conf file - etc/php/7.2/cli "php.ini"
4- set: sendmail_path = /usr/sbin/sendmail_path
5- restart apache services
*/
