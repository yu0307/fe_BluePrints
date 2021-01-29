<?php

namespace feiron\fe_blueprints\commands;

use Illuminate\Console\Command;
use feiron\fe_blueprints\lib\wizards\bp_wizardMakePage;

class fe_BluePrintsMakePage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bp:makePage 
                            {name? : Page Name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Building a page with the wizard and installs into the framework';

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
    {
        (new bp_wizardMakePage($this))->build();
    }
}
