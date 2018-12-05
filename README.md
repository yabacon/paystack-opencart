# Paystack OpenCart Extension

## Description
OpenCart Paystack payment gateway integration. Visit the [Paystack Website](http://paystack.com) to know how paystack works.
Install to receive payments for your goods in naira from any Mastercard, Visa or Verve card in the world.

## Requirements
- Curl 7.34.0 or more recent
- PHP 5.5.19 or more recent
- OpenSSL v1.0.1 or more recent

## Notes
- Paystack currently only accepts the following currencies: `NGN`, `GHS` and `USD`.
- You need to have created an account on [paystack.com](https://dashboard.paystack.co/#/signup).

## Features:
- Paystack payment gateway integration
- Activates payment module only when cart currency is `NGN`, `GHS` or `USD`.
- Activate payment module only when order total reaches the amount you specified
- Captures call back notification to automatically update order status
- Simply turn on Live Mode to accept live payments.

## Installation
0. Visit [Paystack OpenCart Extension](http://www.opencart.com/index.php?route=extension/extension/info&extension_id=25767&filter_search=paystack) to download the latest release.
1. Unzip the files. Select the right version for your OpenCart.
2. Upload the files to your OpenCart installation folder with a FTP client 
                     `OR`
3. Upload the zipped file to the root of your OpenCart installation then unzip using cPanel File Manager. The folders should merge. 
4. In admin panel, proceed to ‘Extensions > Payment’ and install ‘Paystack’.
5. Configure the module accordingly. 
 - To get your live and test secret keys, visit [the Paystack Dashboard](https://dashboard.paystack.co/#/settings/developer).
6. Enable Paystack payment gateway on your OpenCart admin.
7. Add and set NGN, GHS or USD. as your default store currency.
8. Proceed to [Paystack OpenCart Extension](http://www.opencart.com/index.php?route=extension/extension/info&extension_id=25767&filter_search=paystack) to rate our work.

## Other Configuration
To add currencies, you can do so at System > Localisation > Currencies. 

## Documentation
* [Paystack Documentation](https://developers.paystack.co/v2.0/docs/)
* [Paystack Helpdesk](https://paystack.com/help)

## Support
For bug reports and feature requests directly related to this plugin, please use the [issue tracker](https://github.com/PaystackHQ/paystack-payment-forms-for-wordpress/issues). 

For questions related to using the plugin, please post an inquiry to the plugin [support forum](https://wordpress.org/support/plugin/payment-forms-for-paystack).

For general support or questions about your Paystack account, you can reach out by sending a message from [our website](https://paystack.com/contact).

## Community
If you are a developer, please join our Developer Community on [Slack](https://slack.paystack.com).

## Contributing to Payment Forms for Paystack

If you have a patch or have stumbled upon an issue with the Paystack Gateway for Paid Membership Pro plugin, you can contribute this back to the code. Please read our [contributor guidelines](https://github.com/PaystackHQ/plugin-opencart/blob/master/CONTRIBUTING.md) for more information how you can do this.

