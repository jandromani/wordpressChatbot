<?php
/*
Plugin Name: Widget Chatbot GPT
Plugin URI: https://www.ejemplo.com/
Description: Widget de chatbot para Wordpress utilizando la tecnología de ChatGpt.
Version: 1.0
Author: Tu nombre
Author URI: https://www.ejemplo.com/
*/

// Registrar el widget
function chatbot_gpt_registrar_widget() {
  register_widget('Chatbot_Gpt_Widget');
}
add_action('widgets_init', 'chatbot_gpt_registrar_widget');

// Widget de chatbot
class Chatbot_Gpt_Widget extends WP_Widget {
  // Constructor
  function __construct() {
    parent::__construct(
      'chatbot_gpt_widget', // ID del widget
      __('Chatbot GPT Widget', 'chatbot_gpt'), // Nombre visible del widget
      array('description' => __('Un widget de chatbot para Wordpress utilizando la tecnología de ChatGpt.', 'chatbot_gpt')) // Descripción del widget
    );
  }

  // Formulario del widget
  function form($instancia) {
    // Opciones por defecto
    $opciones = array(
      'titulo' => __('Chatbot GPT', 'chatbot_gpt'),
      'texto_introductorio' => __('Escribe tu mensaje aquí...', 'chatbot_gpt')
    );

    // Obtener opciones guardadas
    $opciones = wp_parse_args($instancia, $opciones);

    // Campos del formulario
    echo '<p>';
    echo '<label for="' . $this->get_field_id('titulo') . '">' . __('Título:', 'chatbot_gpt') . '</label>';
    echo '<input class="widefat" type="text" id="' . $this->get_field_id('titulo') . '" name="' . $this->get_field_name('titulo') . '" value="' . esc_attr($opciones['titulo']) . '">';
    echo '</p>';

    echo '<p>';
    echo '<label for="' . $this->get_field_id('texto_introductorio') . '">' . __('Texto introductorio:', 'chatbot_gpt') . '</label>';
    echo '<input class="widefat" type="text" id="' . $this->get_field_id('texto_introductorio') . '" name="' . $this->get_field_name('texto_introductorio') . '" value="' . esc_attr($opciones['texto_introductorio']) . '">';
    echo '</p>';
  }

  // Actualizar opciones del widget
  function update($nuevas_instancias, $viejas_instancias) {
    $opciones = $viejas_instancias;

    $opciones['titulo'] = sanitize_text_field($nuevas_instancias['titulo']);
    $opciones['texto_introductorio'] = sanitize_text_field($nuevas_instancias['texto_introductorio']);

    return $opciones;
  }
}

  // Mostrar widget
  function widget($args, $instancia) {
    // Obtener opciones guardadas
    $opciones = wp_parse_args($instancia, array(
      'titulo' => __('Chatbot GPT', 'chatbot_gpt'),
      'texto_introductorio' => __('Escribe tu mensaje aquí...', 'chatbot_gpt')
    ));


    // Imprimir HTML del widget
    echo $args['before_widget'];
    echo $args['before_title'] . $opciones['titulo'] . $args['after_title'];
    echo '<div class="chatbot-gpt-widget">';
    echo '<div class="chatbot-gpt-mensajes"></div>';
    echo '<div class="chatbot-gpt-input-container">';
    echo '<input type="text" class="chatbot-gpt-input" placeholder="' . esc_attr($opciones['texto_introductorio']) . '">';
    echo '<button class="chatbot-gpt-submit">' . __('Enviar', 'chatbot_gpt') . '</button>';
    echo '</div>';
    echo '</div>';
    echo $args['after_widget'];
  }