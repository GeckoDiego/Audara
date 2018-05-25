<?php

namespace App\Listeners;

use DB;
use App\Events\Event;
use Request;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogSuccessfulLogout
{
    /**
     * Create the event listener.
     *
     * @param  Request  $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  Event  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        $user = $event->user;              
        $data = array(
            'user_id' => $user->id,
            'username' => $user->username,
            'action' => 'OUT',
            'ip_address' => Request::ip(),
            'computer_name' => Request::server('COMPUTERNAME'),
            'os' => Request::server('OS'),
            'os_session_name' => Request::server('USERNAME'),
            'user_agent' => Request::header('user-agent'),
            'last_logout_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s')
        );
        DB::table('user_history')->insert($data);
    }
}