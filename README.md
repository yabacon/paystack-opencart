# eyowo-opencart

## Description
Payment gateway plugin of eyowo.com for open cart shopping cart system.
Enables processing of nigerian interswitch, visa, etranzact and visa cards.

## Installation
This source is available on Github[http://github.com/stackempty/eyowo-opencart/].
To install it, simply download and copy into the root of your open cart application.

## Configuration
Simply go to your admin,

extensions -> payments -> eyowo. Install, then edit and fill in the form as appropraite.
you can only have a walletcode after you have opened an eyowo merchant accont.

### Eyowo Configuration
open a merchant account on eyowo.com, and add a new wallet to your account.
proceed and edit the wallet details as follows,

    calling domain: The main domain of where your application is hosted, e.g mycart.com
    enable gateway payments: checked
    success url: http://<domain root>/index.php?route=payment/eyowo/callback e.g
    http://mycart.com/index.php?route=payment/eyowo/callback
    enable apn: checked
    enable api access: checked

Finally enable eyowo payment gateway on your opencart admin.
and we are done.

having any issues using this plugin, please contact the author

## Authors

Dami Akinsiku <dami.akinsiku@eyowo.com>