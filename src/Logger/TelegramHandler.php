<?php

namespace Logger;

use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
use DB;
use Illuminate\Support\Facades\Auth;
use Telegram\Bot\Api;


class TelegramHandler extends AbstractProcessingHandler
{
    protected $bot;
    protected $chatId;

    public function __construct(array $config,int $level = Logger::DEBUG,bool $bubble = true) {
        $this->bot = new Api($config['botKey']);
        $this->chatId = $config['chatId'];
        parent::__construct($level, $bubble);
    }

    protected function write(array $record) {
        $message  = '*'.$record['level_name'].'* on Motorsports Cloud'.PHP_EOL;
        $message .= 'Host: `'.gethostname().'`'.PHP_EOL;
        $message .= 'Channel: '.$record['channel'].PHP_EOL;
        $message .= 'Message: '.$record['message'].PHP_EOL;
        $message .= 'Remote Address: '.(isset($_SERVER['REMOTE_ADDR']) ? ip2long($_SERVER['REMOTE_ADDR']) : 'N/A').PHP_EOL;
        $message .= 'User Agent :'.(isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'N/A').PHP_EOL;
        $message .= 'User: '.(Auth::id() > 0 ? Auth::id() : 'None').PHP_EOL;
        $message .= 'Context: '.PHP_EOL;
        $message .= '```json'.PHP_EOL.json_encode($record['context'],JSON_PRETTY_PRINT).PHP_EOL.'```';
        $messageArray = [
            'chat_id' => $this->chatId,
            'text' => $message,
            'parse_mode' => 'Markdown',
            'disable_web_page_preview' => true,
        ];
        $this->bot->sendMessage($messageArray);

    }
}