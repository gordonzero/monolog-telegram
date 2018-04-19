## Laravel 5.6 Monolog Telegram Notification Handler.

This package will sends an message Via Telegram to a spedified group or user speicifed by the `LOG_TELEGRAM_CHAT_ID`.
### Installation

~~~
composer require gordonzero/monolog-telegram
~~~

Open up `config/logging.php` and find the `channels` key. Add the following channel to the list.

~~~
'telegram' => [
    'driver' => 'custom',
    'via'=> \Logger\TelegramLogger::class,
    'botKey' => env('LOG_TELEGRAM_BOT_ID'),
    'chatId' => env('LOG_TELEGRAM_CHAT_ID'),
],
~~~

Add the following information to your `.env` file. Your `LOG_TELEGRAM_BOT_ID` is for the your bot key and `LOG_TELEGRAM_CHAT_ID` is the chat ID for a telegram user or channel.
~~~
LOG_TELEGRAM_BOT_ID=123456789:ABCDEFGHIJKLMNOPQUSTUFWXYZabcdefghi
LOG_TELEGRAM_CHAT_ID=12345678
~~~

This package contains a blank Service Provider. This is only to let you know that the package is detected and working properly. 

### Side Notes

Currently it does not have any built in methods for figuring out what your `CHAT_ID` is. This may come in a future version or you can check around for posts that tell you how to find this ID number.