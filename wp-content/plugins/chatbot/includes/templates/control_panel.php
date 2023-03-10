<div class="wrap">
  <h1>Configuración de Chatbot</h1>
  <?php if (isset($_POST['guardar_configuracion'])) { ?>
    <div class="notice notice-success is-dismissible">
      <p>La configuración ha sido guardada.</p>
    </div>
  <?php } ?>
  <form method="post">
    <table class="form-table">
      <tr>
        <th><label for="idioma_chatbot">Idioma del chatbot:</label></th>
        <td>
          <select name="idioma_chatbot" id="idioma_chatbot">
            <option value="es" <?php selected($configuracion_chatbot['idioma'], 'es'); ?>>Español</option>
            <option value="en" <?php selected($configuracion_chatbot['idioma'], 'en'); ?>>Inglés</option>
            <option value="fr" <?php selected($configuracion_chatbot['idioma'], 'fr'); ?>>Francés</option>
          </select>
        </td>
      </tr>
      <tr>
        <th><label for="tono_chatbot">Tono del chatbot:</label></th>
        <td>
          <select name="tono_chatbot" id="tono_chatbot">
            <option value="formal" <?php selected($configuracion_chatbot['tono'], 'formal'); ?>>Formal</option>
            <option value="informal" <?php selected($configuracion_chatbot['tono'], 'informal'); ?>>Informal</option>
          </select>
        </td>
      </tr>
    </table>
    <input type="hidden" name="accion" value="guardar_configuracion">
    <?php wp_nonce_field('chatbot_gpt_guardar_configuracion', 'chatbot_gpt_nonce'); ?>
    <?php submit_button('Guardar configuración', 'primary', 'guardar_configuracion'); ?>
  </form>
</div>
