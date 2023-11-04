<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateRepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $repositoryContent = '<?php' . PHP_EOL . PHP_EOL . 'namespace App\Repositories;' . PHP_EOL . PHP_EOL . 'use App\Interfaces\\' . $name . 'Interface;' . PHP_EOL . PHP_EOL . 'class ' . $name . 'Repository implements ' . $name . 'Interface' . PHP_EOL . '{' . PHP_EOL . "\tpublic function __construct()" . PHP_EOL . "\t{" . PHP_EOL . "\t\t// Your constructor code here" . PHP_EOL . "\t}" . PHP_EOL . '}';
        $repositoryPath = app_path('Repositories/' . $name . 'Repository.php');

        file_put_contents($repositoryPath, $repositoryContent);
    }
}
