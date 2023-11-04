<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CreateMoMiCIR extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:files {filename} {v1}';
    // protected $signature = 'create:codefile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Files of Model, Migration, Controller, Repository & Interface';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = Str::ucfirst($this->argument('filename'));
        $v1 = $this->argument('v1');
        $allow_commands = str_split($v1);

        if (in_array('m', $allow_commands)) {
            Artisan::call('make:model', [
                'name' => $filename,
                '-m' => true
            ]);
        }

        if (in_array('c', $allow_commands)) {
            // Artisan::call('make:controller', [
            //     'name' => $filename . 'Controller',
            // ]);
            Artisan::call('create:controller ' . $filename);
        }
        if (in_array('i', $allow_commands)) {
            Artisan::call('create:interface ' . $filename);
        }

        if (in_array('r', $allow_commands)) {
            Artisan::call('create:repository ' . $filename);
        }
    }
}
