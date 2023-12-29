<?php
/*
 * Plugin Name:       Debales AI Assistant
 * Plugin URI:        https://debales.ai/
 * Description:       This plugin will help you to integrate Debales AI Assistant Chatbot into your website.
 * Version:           0.1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Debales
 * Author URI:        https://debales.ai/
 * License:           Custom
 * Update URI:        https://debales.ai/
 */

define('chatbox_api', 'https://saas.brainlox.com');
$api_key = get_option('debales_chatbot_bot_id');

define('api_key', $api_key);


function debales_chatbot_settings_page()
{
    add_options_page(
        'Debales Chatbot Settings',
        'Debales Chatbot',
        'manage_options',
        'debales-chatbot-settings',
        'debales_chatbot_settings_form'
    );
}
add_action('admin_menu', 'debales_chatbot_settings_page');

function debales_chatbot_settings_form()
{
?>
    <div class="wrap">
        <h2>Custom Chatbot Settings</h2>
        <form method="post" action="options.php">
            <?php settings_fields('debales-chatbot-settings-group'); ?>
            <?php do_settings_sections('debales-chatbot-settings'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">BOT ID</th>
                    <td>
                        <input type="text" name="debales_chatbot_bot_id" value="<?php echo esc_attr(get_option('debales_chatbot_bot_id')); ?>" />
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

function debales_chatbot_register_settings()
{
    register_setting(
        'debales-chatbot-settings-group',
        'debales_chatbot_bot_id'
    );
}
add_action('admin_init', 'debales_chatbot_register_settings');


function addchatbotinfooter()
{

    if (api_key != '') {

    ?>
        <div id="debales-ai-assistant" data-bot-id="<?php echo api_key?>"></div>
        <script type="module" crossorigin src='<?php echo plugin_dir_url(__DIR__); ?>debales-ai-assistant/debales-ai-assistant.min.js'></script>
<?php
    }
}


add_action('wp_footer', 'addchatbotinfooter');


?>