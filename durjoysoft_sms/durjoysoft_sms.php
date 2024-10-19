<?php
require_once("functions.php");

if (!defined("WHMCS"))
    die("This file cannot be accessed directly");
//defien current path
define("DURJOYSOFT_SMS_PATH", dirname(__FILE__));

function durjoysoft_sms_config()
{
    $configarray = array(
        "name"        => "Durjoysoft SMS",
        "description" => 'Durjoysoft SMS WHMCS SMS Addon. You can see details from <a href="https://durjoysms.durjoysoft.com" target="_blank">Durjoysoft</a>',
        "version"     => "1.0.1",
        "author"      => "Durjoysoft",
        "language"    => "english",
        "logo"        => 'data:image/png;base64,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',
    );

    return $configarray;
}


function durjoysoft_sms_activate()
{

    $query = "CREATE TABLE IF NOT EXISTS `durjoysoft_sms_templates`(
        `id` INT NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(50) NOT NULL,
        `user_type` ENUM('client', 'admin') NOT NULL,
        `admin_numbers` VARCHAR(255) NOT NULL,
        `content` TEXT NOT NULL,
        `variables` VARCHAR(500) NOT NULL,
        `is_active` TINYINT NOT NULL,
        `extra_info` VARCHAR(3) NOT NULL COMMENT 'to store domain renew before expiry days',
        `description` TEXT NULL,
        PRIMARY KEY (`id`)
    )";

    mysql_query($query);


    $query = "CREATE TABLE IF NOT EXISTS `durjoysoft_sms_settings`(
        `id` INT NOT NULL AUTO_INCREMENT,
        `api_key` VARCHAR(40) NOT NULL,
        `sender_id` VARCHAR(100) NOT NULL,
        `version` VARCHAR(6) NULL,
        PRIMARY KEY (`id`)
    )";

    mysql_query($query);


    $query = "CREATE TABLE IF NOT EXISTS `durjoysoft_sms_messages`(
        `id` INT NOT NULL AUTO_INCREMENT,
        `sender_id` VARCHAR(40) NOT NULL,
        `recipient` VARCHAR(15) NULL,
        `message` TEXT NULL,
        `req_id` BIGINT NOT NULL,
        `status` VARCHAR(10) NULL,
        `error_details` TEXT NULL,
        `log_details` TEXT NULL,
        `client_id` INT NULL,
        `created` DATETIME NOT NULL,
        PRIMARY KEY (`id`)
    )";

    mysql_query($query);

    $query = "INSERT INTO `durjoysoft_sms_settings` (`id`, `api_key`, `sender_id`, `version`) VALUES
    (1, '', '', '1.0.0')";

    mysql_query($query);

    $function = new Functions();
    $function->checkHooks();

    return array('status' => 'success', 'description' => 'durjoysoft_sms successfully activated.');
}

function durjoysoft_sms_deactivate()
{
    $query = "DROP TABLE IF EXISTS `durjoysoft_sms_templates`";
    mysql_query($query);

    $query = "DROP TABLE IF EXISTS `durjoysoft_sms_settings`";
    mysql_query($query);

    $query = "DROP TABLE IF EXISTS `durjoysoft_sms_messages`";
    mysql_query($query);

    $query = "DROP TABLE IF EXISTS `durjoysoft_sms_otp`";
    mysql_query($query);

    return array('status' => 'success', 'description' => 'durjoysoft_sms successfully deactivated.');
}

function durjoysoft_sms_upgrade()
{
}

function durjoysoft_sms_output()
{

    function showAlert($message, $type = 'success')
    {
        echo '<div class="alert alert-' . $type . ' alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span></button>' . $message . '</div>';
    }

    function formatHookName($inputString)
    {

        $formattedString = preg_replace('/_admin$/', '', $inputString);
        // Remove any extra spaces at the beginning or end
        $formattedString = trim($formattedString);

        return $formattedString;
    }


    try {

        $tab = isset($_GET['tab']) ? $_GET['tab'] : 'settings';

        //include style
        include_once DURJOYSOFT_SMS_PATH . '/partials/style.php';

        //if tab not found
        if (!file_exists(DURJOYSOFT_SMS_PATH . '/tabs/' . $tab . '.php')) {
            throw new Exception("Tab not found");
        }

        include_once DURJOYSOFT_SMS_PATH . '/tabs/' . $tab . '.php';
    } catch (\Throwable $th) {

        //include style
        include_once DURJOYSOFT_SMS_PATH . '/partials/style.php';

        include_once DURJOYSOFT_SMS_PATH . '/tabs/' . '404' . '.php';
    }
}