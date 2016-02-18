# Paystack OpenCart Extension

## Description
OpenCart Paystack payment gateway integration. Visit the [Paystack Website](http://paystack.com) to know how it works.
Install to receive payments for your goods in naira from any card in the world.

## Notes
- Paystack currently only accepts the following currencies: `NGN`.
- Paystack currently only accepts Nigerian registered businesses.
- You need to have created an account on [paystack.com](https://dashboard.paystack.co/#/signup).


## Features:
• Paystack payment gateway integration
• Activate payment module only when order total reaches the amount you specified
• Captures call back notification to automatically update order status
• Test mode for testing
• Currency conversion for unsupported currency

## Installation
0. Visit [OpenCart Extensions](http://www.opencart.com/index.php?route=extension/extension) to download the latest release.
1. Unzip the files. Select the right version for your OpenCart.
2. Upload the files WITHIN the ‘upload’ folder to your OpenCart installation folder with a FTP client. The folders should merge. 
 - [1.5.x upload](1.5.x/upload) will work with OpenCart. 1.5.x
 - [2.x upload](2.x/upload) should work with OpenCart. 2.x
3. In admin panel, proceed to ‘Extensions > Payment’ and install ‘Paystack’.
4. Configure the module accordingly. 
 - To get your live and test secret keys, visit [the Paystack Dashboard](https://dashboard.paystack.co/#/settings/developer).
 - Set the callback url thus: http://<domain root>/index.php?route=payment/paystack/callback e.g http://mycart.com/index.php?route=payment/paystack/callback
5. Enable Paystack payment gateway on your OpenCart admin.
6. Proceed to [OpenCart Extensions](http://www.opencart.com/index.php?route=extension/extension) to rate our work.

## Other Configuration
To add currencies, you can do so at System > Localisation > Currencies. You can leave the currency as ‘disabled’ if you do not wish to have it display at the store front.


## Authors
Ibrahim Lawal

