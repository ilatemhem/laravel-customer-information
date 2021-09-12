<?php

namespace App\Console\Commands;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMailToMarketing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:marketing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pazarlamaya her akşam 8\'de mail atan komut';

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
        $marketingCustomers = Customer::where('department_id', 2)->get();

        $bar = $this->output->createProgressBar(count($marketingCustomers));
        $bar->start();

        foreach ($marketingCustomers as $marketingCustomer){
            try {
                Mail::send(
                    function ($message) use ($marketingCustomer) {
                        $message->to($marketingCustomer->email);
                        $message->subject('Muhasebe Departmanı');
                        $message->body('');
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
