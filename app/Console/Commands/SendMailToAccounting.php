<?php

namespace App\Console\Commands;

use App\Models\Customer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMailToAccounting extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:accounting';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Muhasebeye her sabah 8\'de mail atan komut';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $accountingCustomers = Customer::where('department_id', 1)->get();

        $bar = $this->output->createProgressBar(count($accountingCustomers));
        $bar->start();

        foreach ($accountingCustomers as $accountingCustomer){
            try {
                Mail::send(
                    function ($message) use ($accountingCustomer) {
                        $message->to($accountingCustomer->email);
                        $message->subject('Muhasebe Departmanı');
                    }
                );

            } catch (\Exception $exception) {
                $this->output->warning($exception->getMessage());
            }
            $bar->advance();
        }
        $bar->finish();

        $this->output->success('Done.');
    }
}
