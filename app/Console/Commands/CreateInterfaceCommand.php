<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateInterfaceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:interface {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new interface';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $interfaceContent = '<?php' . PHP_EOL .PHP_EOL . 'namespace App\Interfaces;' . PHP_EOL . PHP_EOL . 'interface ' . $name.'Interface' . PHP_EOL . '{' . PHP_EOL . "\t//" . PHP_EOL . '}';
        $interfacePath = app_path('Interfaces/' . $name . 'Interface.php');

        file_put_contents($interfacePath, $interfaceContent);
    }
}
