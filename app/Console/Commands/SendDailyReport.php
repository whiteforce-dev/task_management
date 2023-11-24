<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\DailyReport;
use App\Models\DailyStandup;
use App\Models\Taskmaster;
use App\Models\CheckoutDetails;
use Illuminate\Support\Facades\Auth;

class SendDailyReport extends Command
{
    protected $signature = 'send:daily-report';
    protected $description = 'Send daily report email';

    public function handle()
    {
        $checkins = DailyStandup::where('date',date('Y-m-d'))->whereNotNull('checkin')->value('checkin');
        $data = Taskmaster::whereIn('id',explode(',',$checkins))->select('id','task_code','task_name')->get();
        // $checkout_tasks = collect(CheckoutDetails::whereIn('id',explode(',',$data->checkout))->with('GetTask:id,task_code,task_name')->get());
        // $total_hours = $checkout_tasks->sum('hours');
        // $total_minutes = $checkout_tasks->sum('minutes');
        Mail::to('shivmehra50@gmail.com')->send(new DailyReport($data));
        $this->info('Daily report sent successfully!');
    }
}
