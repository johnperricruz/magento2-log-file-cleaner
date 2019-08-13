## Log Cleaner for Magento 2.2


## Installation  : 
1. Copy Jpc/LogRotation to app/code/Jpc/LogRotation
2. Run php bin/magento setup:upgrade
3. Run php bin/magento setup:di:compile

## How it works : 
1. It is running via cron every monday at 00:00 using job code : jpc_logrotation_clean
2. Logs inside var/log will be moved to var/backup/log/{YEAR}/{MONTH}/{DAY} so var/log will be pretty clean for monitoring purposes.

## Security Vulnerabilities

If you discover a security vulnerability within this framework, please send an e-mail to John Perri Cruz at johnperricruz@gmail.com. All security vulnerabilities will be promptly addressed.

## License

This Module is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).