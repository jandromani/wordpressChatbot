<?php
/*
Plugin Name: Chatbot GPT
Plugin URI: https://www.ejemplo.com/
Description: Plugin de chatbot para Wordpress utilizando la tecnología de ChatGpt.
Version: 1.0
Author: Tu nombre
Author URI: https://www.ejemplo.com/
*/

// Agregar archivos JS y CSS
function chatbot_gpt_cargar_scripts() {
  wp_enqueue_style('chatbot', plugin_dir_url(__FILE__) . 'chatbot.css');
  wp_enqueue_script('chatbot', plugin_dir_url(__FILE__) . 'chatbot.js', array('jquery'));
  wp_localize_script('chatbot', 'chatbot_gpt_vars', array(
    'ajax_url' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('chatbot_gpt_nonce')
  ));
}
add_action('wp_enqueue_scripts', 'chatbot_gpt_cargar_scripts');

// Procesar mensajes del chatbot
function chatbot_gpt_enviar_mensaje() {
  $respuesta = array();

  // Verificar nonce
  if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'chatbot_gpt_nonce')) {
    $respuesta['error'] = 'Nonce inválido.';
  } else {
    // Obtener mensaje del usuario
    $mensaje = sanitize_text_field($_POST['mensaje']);

    // Llamar a la API de ChatGpt
    // Aquí iría el código para llamar a la API de ChatGpt y obtener la respuesta del chatbot
    // Por simplicidad, en este ejemplo solo se devuelve el mensaje original del usuario como respuesta
    $respuesta['mensaje'] = $mensaje;
  }

  // Devolver respuesta en formato JSON
  wp_send_json($respuesta);
}
add_action('wp_ajax_enviar_mensaje_chatbot', 'chatbot_gpt_enviar_mensaje');
add_action('wp_ajax_nopriv_enviar_mensaje_chatbot', 'chatbot_gpt_enviar_mensaje');
