<?php

$hook = array(
    'hook'           => 'AfterRegistrarRenewal',
    'function'       => 'AfterRegistrarRenewalAdmin',
    'description' => 'When domain is renewed.',
    'type'           => 'admin',
    'extra'          => '',
    'defaultmessage' => 'The domain name {domain} has been renewed.',
    'variables' => '{domain},{company}'
);

if (!function_exists('AfterRegistrarRenewalAdmin')) {
    function AfterRegistrarRenewalAdmin($args)
    {
        $class    = new Functions();
        $template = $class->getTemplateDetails(__FUNCTION__);
        if ($template['is_active'] == 0) {
            return null;
        }
        $settings = $class->getSettings();
        if (empty($settings['api_key'])) {
            logActivity('durjoysoft_sms - AfterRegistrarRenewalAdmin :  ' . 'No API Key Provided', 0);
            return null;
        }
        $company_details = $class->getCompanyName();

        $admin_numbers              = explode(",", $template['admin_numbers']);
        $template['variables'] = str_replace(" ", "", $template['variables']);
        $replacefrom           = explode(",", $template['variables']);
        $replaceto = array($args['params']['sld'] . "." . $args['params']['tld'], $company_details['CompanyName']);
        $message               = str_replace($replacefrom, $replaceto, $template['content']);
        foreach ($admin_numbers as $gsm) {
            if (!empty($gsm)) {

                if (!$class->validatePhoneNumber($gsm)) {
                    logActivity('durjoysoft_sms - AfterRegistrarRenewalAdmin :  ' . 'Invalid phone number Provided', 0);
                    continue;
                }

                $class->setNumber(trim($gsm));
                $class->setUserid(0);
                $class->setMessage($message);
                $class->send();
            }
        }
    }
}

return $hook;
