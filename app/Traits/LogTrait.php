<?php 

namespace App\Traits;

use Auth;
use DB;
use Carbon\Carbon;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

trait LogTrait{

    public function LogFile($stream, $event, $data){
        $log = new Logger($stream);
        $logStreamHandler = new StreamHandler(storage_path("/logs/".$stream."-".Carbon::today()->toDateString().".log"), Logger::INFO, false);

        $logFormat = "%datetime% [%level_name%] (%channel%): %message%\n";
        $formatter = new LineFormatter($logFormat);
        $logStreamHandler->setFormatter($formatter);

        $log->pushHandler($logStreamHandler);
        $log->info($event .' - '. json_encode($data));
    }

    public function LogDB($user_id, $type, $event_name, $ip, $event_id=NULL, $public=true){

        DB::table('logs')->insert([
            'user_id' => $user_id,
            'type' => $type,
            'event' => $event_name,
            'event_id' => $event_id,
            'ip_address' => $ip,
            'public' => $public,
        ]);
    }
}