<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Car;

class GenerateDummyDate extends Command
{
    const COUNT = 10000;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:dummy-data {count}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate dummy data';

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
     * @return mixed
     */
    public function handle() 
    // оснавная логика всей консольной команды.
    {
        $count = $this->argument('count');
        $this->info("Generating $count random records");

        for($i = 0; $i < $count; $i++){
            factory(Car::class)->create();
        }
    }
}
