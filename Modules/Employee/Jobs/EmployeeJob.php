<?php

namespace Modules\Employee\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use Modules\Employee\Emails\SendEmail;

class EmployeeJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public $detail;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($detail)
    {
        $this->detail = $detail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->detail['to'])
            ->send(new sendEmail($this->detail));
    }
}
