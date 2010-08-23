<?php

	Class PostMarkApp_Email extends Email{
	
		public function __construct(){
			require_once "postmark-php/Postmark.php";
			parent::__construct();
		}
	
		public function send(){

			$this->validate();

			$credentials = Symphony::Configuration()->get('postmarkapp');
			
			$email = new Mail_Postmark($credentials['api_key'], $credentials['from_name'], $credentials['from_address']);
		
			$email->to($this->recipient)
				->replyTo($this->sender_email_address, $this->sender_name)
				->subject($this->subject)
				->messagePlain($this->message)
				->send();

			return true;
		}	
	}
	
	return 'PostMarkApp_Email';