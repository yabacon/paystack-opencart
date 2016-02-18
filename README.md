# Paystack OpenCart Extension

## Description
OpenCart Paystack payment gateway integration. Visit the [Paystack Website](http://paystack.com) to know how paystack works.
Install to receive payments for your goods in naira from any Mastercard, Visa or Verve card in the world.

## Notes
- Paystack currently only accepts the following currencies: `NGN`.
- You need to have created an account on [paystack.com](https://dashboard.paystack.co/#/signup).

## Features:
• Paystack payment gateway integration
• Activates payment module only when cart currency is `NGN`
• Activate payment module only when order total reaches the amount you specified
• Captures call back notification to automatically update order status
• Simply turn on Live Mode to accept live payments.

## Installation
0. Visit [Paystack OpenCart Extension](http://www.opencart.com/index.php?route=extension/extension/info&extension_id=25767&filter_search=paystack) to download the latest release.
1. Unzip the files. Select the right version for your OpenCart.
2. Upload the files to your OpenCart installation folder with a FTP client 
                     `OR`
3. Upload the zipped file to the root of your OpenCart installation then unzip using cPanel File Manager. The folders should merge. 
4. In admin panel, proceed to ‘Extensions > Payment’ and install ‘Paystack’.
5. Configure the module accordingly. 
 - To get your live and test secret keys, visit [the Paystack Dashboard](https://dashboard.paystack.co/#/settings/developer).
 - Set the callback url thus: http://<domain root>/index.php?route=payment/paystack/callback e.g http://mycart.com/index.php?route=payment/paystack/callback
6. Enable Paystack payment gateway on your OpenCart admin.
7. Add and set NGN as your default store currency.
8. Proceed to [Paystack OpenCart Extension](http://www.opencart.com/index.php?route=extension/extension/info&extension_id=25767&filter_search=paystack) to rate our work.

## Other Configuration
To add currencies, you can do so at System > Localisation > Currencies. 


## Authors
Ibrahim Lawal

