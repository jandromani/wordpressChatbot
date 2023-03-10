<?php

class ChatGpt_API {
  private $api_key = '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'; 
  private $api_url = 'https://api.chatgpt.com';

  public function __construct($api_key) {
    $this->api_key = $api_key;
  }

  public function send_message($message, $language = 'en', $tone = 'neutral') {
    $request_url = $this->api_url . '/chatbot/send-message';
    $data = array(
      'api_key' => $this->api_key,
      'message' => $message,
      'language' => $language,
      'tone' => $tone
    );

    $options = array(
      'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
      ),
    );

    $context  = stream_context_create($options);
    $response = file_get_contents($request_url, false, $context);
    return json_decode($response, true);
  }
}

?>
