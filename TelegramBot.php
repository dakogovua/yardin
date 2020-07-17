<?php
class TelegramBot {
	protected $token ='1016236033:AAE2T70_wf_EycfOb96XMY80dU9dD0y9YxE';

	protected functon query($method, $param = []){
		$url = 'https://api.telegram.org/bot';
		$url .= $this -> token;
	}

	public functon getUpdates(){

	}

	public functon sendMessage(){
		
	}

}