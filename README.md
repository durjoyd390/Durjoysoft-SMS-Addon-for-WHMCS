# Durjoysoft SMS Addon for WHMCS

Durjoysoft SMS Addon allows you to send SMS notifications to your clients directly from WHMCS. Follow the instructions below to install and configure the addon.

## Requirements

- WHMCS version 7.0 or higher
- PHP version 7.0 or higher

## Installation

1. **Download the Addon:**
   Download the Durjoysoft SMS addon.

2. **Upload the Files:**
   - Extract the downloaded ZIP file.
   - Upload the `durjoysoft_sms.zip` file to the `modules/addons/` directory of your WHMCS installation.
   - Extract the `durjoysoft_sms.zip` file then delete it.

3. **Activate the Addon:**
   - Log in to your WHMCS Admin area.
   - Navigate to **Configuration** > **System Settings** > **Addon Modules**.
   - You should see "Durjoysoft SMS" in the list of available addons. 
   - Click the **Activate** button next to it.
   - Click the **Configure** button & Choose the admin role groups to permit access to this module.
   - Click the **Save Changes** button.

4. **Configure the Addon:**
   - Now Navigate to **Addons** > **Durjoysoft SMS** .
   - Enter your API Key and Sender ID in the settings.
   - Save the changes.

5. **Check Permissions:**
   Ensure that the following directories have the appropriate permissions:
   - `modules/addons/durjoysoft_sms/`

## Usage

Once the addon is activated and configured, you can start sending SMS notifications from your WHMCS installation. You can manage SMS templates and settings through the addon interface.

### SMS Templates

- You can create and manage SMS templates under the **Templates** tab in the Durjoysoft SMS Addon interface.
- Customize the content and variables as needed.

## Support

If you encounter any issues or have questions, please reach out to our support team at [info@durjoysoft.com](mailto:info@durjoysoft.com).

## License

This addon is licensed under the [MIT License](LICENSE).

## Acknowledgements

- [WHMCS](https://www.whmcs.com/) for providing the platform.
- [Durjoysoft](https://durjoysoft.com/) for development and support.
