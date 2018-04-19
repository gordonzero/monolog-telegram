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
        $message = $record['formatted'];
        $messageArray = [
            'chat_id' => $this->chatId,
            'text' => $message,
            'parse_mode' => 'Markdown',
            'disable_web_page_preview' => true,
        ];
        $this->bot->sendMessage($messageArray);
        /*
        $data = [
            'instance' => gethostname(),
            'message' => $record['message'],
            'channel' => $record['channel'],
            'level' => $record['level'],
            'level_name' => $record['level_name'],
            'context' => json_encode($record['context']),
            'remote_addr' => isset($_SERVER['REMOTE_ADDR']) ? ip2long($_SERVER['REMOTE_ADDR']) : null,
            'user_agent' => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null,
            'created_by' => Auth::id() > 0 ? Auth::id() : null,
            'created_at' => $record['datetime']->format('Y-m-d H:i:s')
        ];
        DB::connection($this->connection)->table($this->table)->insert($data);*/
    }
}