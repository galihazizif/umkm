<?php

// require_once('../umkm/pruotected/extensions/PHPMailer/PHPMailerAutoload.php');
require_once(dirname(__FILE__).'/../extensions/PHPMailer/PHPMailerAutoload.php');
class SendMail extends PHPMailer{

	private $_hasSmtpServer = false;
	public $isHTML = true;

	public function kirim($obj){
		// array obj Index
		// *subject
		// *body
		// *destination_email
		// *destination_name

		$this->isSMTP();

		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$this->SMTPDebug = 0;

		//Ask for HTML-friendly debug output
		$this->Debugoutput = 'html';

		//Set the hostname of the mail server
		$this->Host = 'smtp.gmail.com';

		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$this->Port = 587;

		//Set the encryption system to use - ssl (deprecated) or tls
		$this->SMTPSecure = 'tls';

		//Whether to use SMTP authentication
		$this->SMTPAuth = true;

		//Username to use for SMTP authentication - use full email address for gmail
		$this->Username = "umkm.banyumas@gmail.com";

		//Password to use for SMTP authentication
		$this->Password = "hujanabu262";

		//Set who the message is to be sent from
		$this->setFrom('umkm.banyumas@gmail.com', Yii::app()->name);

		//Set who the message is to be sent to
		// $this->addAddress($obj['destination_email'], $obj['destination_name']);

		//Set the subject line
		$this->Subject = $obj['subject'];
		$this->Body = $obj['body'];

		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		// $this->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

		//Attach an image file
		// $this->addAttachment('images/phpmailer_mini.png');
		$dest = '';
		if($this->_hasSmtpServer == true){

			foreach ($obj['destination_email'] as $key => $value) {
				$dest = $dest.$value.',';
			}

			//remove trailing comma
			$dest = substr($dest,0,-1);

			$ctype = ($this->isHTML) ? 'text/html': 'text/plain';

			$headers="From: UMKM <no-reply@unyumas.asia>\r\n".
					"Reply-To: no-reply@unyumas.asia\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: $ctype";

			mail($dest,$obj['subject'],$obj['body'],$headers);			
			return true;
		}else{
			foreach ($obj['destination_email'] as $key => $value) {
				$this->addAddress($value, $obj['destination_name']);
			}

			$this->isHTML();

			if($this->send()){
				return true;
			}else{
				print $this->ErrorInfo;
				return false;
			}
		}

	}
}

?>