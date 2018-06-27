<?php
class class_email {
    
    private $mailer;
            
    function __construct(){
        $this->mailer = new PHPMailer();
        $this->mailer->CharSet = MAIL_CHARSET;
        $this->mailer->From = MAIL_FROM;
        $this->mailer->FromName = SITE_NAME;
        $this->mailer->isHTML(true);
        if(MAIL_SMTP){
            $this->mailer->isSMTP();
			$this->mailer->Host = SMTP_HOST;
			if(SMTP_AUTH){
				$this->mailer->Username = SMTP_USER;
				$this->mailer->Password = SMTP_PASS;
			}
        }
    }   
    
    function email($to, $subject, $message, $attachment=null,$bcc=false){
        $this->mailer->Subject  = stripslashes($subject);
        $this->mailer->Body = stripslashes($message);
        if(@is_array($attachment)){
            foreach($attachment as $v){
                $this->mailer->AddAttachment($v);
            }
        }
        elseif(@$attachment){
            $this->mailer->AddAttachment($attachment);
        }
        if(is_array($to)){
            if($bcc){
                foreach($to as $v){
                    $this->mailer->AddAddress($v);
                    $this->mailer->Send();
                    $this->mailer->ClearAddresses();
                }
                return true;
            }else{
                foreach($to as $v){
                    $this->mailer->AddAddress($v);
                }
            }
        }
        else{
            $this->mailer->AddAddress($to);
        }        

        $ok = $this->mailer->Send();
        $this->mailer->ClearAddresses();
        if($attachment){
            $this->mailer->ClearAttachments();
        }
        usleep(100000);
        if($ok){
            return true;
        }
        else{
            //dump($mailer->ErrorInfo);
            return false;
        }
    }

    function  __destruct() {
        
    }
}
?>