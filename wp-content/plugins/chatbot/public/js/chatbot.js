jQuery(document).ready(function($) {
    var $chatbot = $('#chatbot');
    var $chatbot_input = $('#chatbot-input');
    var $chatbot_messages = $('#chatbot-messages');
  
    $chatbot.submit(function(e) {
      e.preventDefault();
      var mensaje = $chatbot_input.val();
      if (mensaje) {
        $chatbot_messages.append('<div class="mensaje-usuario">' + mensaje + '</div>');
        $chatbot_input.val('');
        enviar_mensaje(mensaje);
      }
    });
  
    function enviar_mensaje(mensaje) {
      var parametros = {
        action: 'enviar_mensaje_chatbot',
        mensaje: mensaje,
        nonce: chatbot_gpt_vars.nonce
      };
      $.post(chatbot_gpt_vars.ajax_url, parametros, function(respuesta) {
        if (respuesta && respuesta.mensaje) {
          $chatbot_messages.append('<div class="mensaje-chatbot">' + respuesta.mensaje + '</div>');
          $chatbot_messages.scrollTop($chatbot_messages[0].scrollHeight);
        }
      });
    }
  });
  