<?php

namespace App\Console\Commands;

use App\Facades\APIClientFacade;
use App\Facades\FruitFacade;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class AddFruits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fruits:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Fruits';

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
     * @return int
     */
    public function handle()
    {
        $fruits = APIClientFacade::get(config('fruits.all_fruits_uri'));

        if (empty($fruits) || !is_array($fruits)) {
            $this->alert("Check the API provider. No fruits found to add!");
            return 0;
        }

        $newlyAddedFruits = FruitFacade::addFruits($fruits);

        $this->info("Successfully added!");

        if (empty($newlyAddedFruits)) {
            $this->info("No new fruits are added to notify to admin.");
            return 0;
        }

        try {
            Mail::send('mail.admin-fruits-notify', ['fruits' => $newlyAddedFruits], function($message) use ($newlyAddedFruits) {
                $message->to(config('mail.admin_email'), config('mail.mailers.from.name'))->subject(__("here are the newly added fruits list."));
            });

            $this->info("Newly added fruits list has been sent to the admin.");
        } catch (\Throwable $throwable) {
            $this->warn("Email didn't send to admin, please configure your .env file.");
        }

        return 1;
    }
}
