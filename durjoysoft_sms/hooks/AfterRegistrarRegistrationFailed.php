<?php
$hook = array(
    'hook'           => 'AfterRegistrarRegistrationFailed',
    'function'       => 'AfterRegistrarRegistrationFailed',
    'description' => 'Domain Registration Failure',
    'type'           => 'client',
    'extra'          => '',
    'defaultmessage' => 'Hi {firstname} {lastname},Your domain name {domain} could not be registered.',
    'variables' => '{firstname},{lastname},{domain},{company}'
);
if (!function_exists('AfterRegistrarRegistrationFailed')) {
    function AfterRegistrarRegistrationFailed($args)
    {
        $class    = new Functions();
        $template = $class->getTemplateDetails(__FUNCTION__);
        if ($template['is_active'] == 0) {
            return null;
        }
        $settings = $class->getSettings();
        if (empty($settings['api_key'])) {
            logActivity('durjoysoft_sms - AfterRegistrarRegistrationFailed :  ' . 'No API Key Provided', 0);
            return null;
        }
        $result   = $class->getClientDetailsBy($args['params']['userid']);

        $company_details = $class->getCompanyName();

        $num_rows = mysql_num_rows($result);
        if ($num_rows == 1) {
            $UserInformation       = mysql_fetch_assoc($result);

            if (!$class->validatePhoneNumber($UserInformation['gsmnumber'])) {
                logActivity('durjoysoft_sms - AfterRegistrarRegistrationFailed :  ' . 'Invalid phone number Provided', 0);
                return null;
            }

            $template['variables'] = str_replace(" ", "", $template['variables']);
            $replacefrom           = explode(",", $template['variables']);
            $replaceto = array($UserInformation['firstname'], $UserInformation['lastname'], $args['params']['sld'] . "." . $args['params']['tld'], $company_details['CompanyName']);
            $message               = str_replace($replacefrom, $replaceto, $template['content']);
            $class->setNumber($UserInformation['gsmnumber']);
            $class->setUserid($args['params']['userid']);
            $class->setMessage($message);
            $status = $class->send();

            if ($status == 'success') {
                logActivity('SMS Notification of Domain Registration Failure Sent Successfully', $args['params']['userid']);
            }
        }
    }
}

return $hook;
