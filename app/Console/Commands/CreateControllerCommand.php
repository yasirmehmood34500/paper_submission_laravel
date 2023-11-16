<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateControllerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:controller {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new controller';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $repositoryContent = "<?php" . PHP_EOL . PHP_EOL . "namespace App\Http\Controllers;" . PHP_EOL . PHP_EOL . "use App\Interfaces\\".$name."Interface;" . PHP_EOL . "use Illuminate\Http\Request;" . PHP_EOL . PHP_EOL . "class ".$name."Controller extends Controller" . PHP_EOL . "{" . PHP_EOL . "\tpublic function __construct(protected " . $name . "Interface $" . Str::snake($name) . "_interface){" . PHP_EOL . "\t //". PHP_EOL ."\t}" . PHP_EOL . "}";
        $repositoryPath = app_path('Http/Controllers/' . $name . 'Controller.php');

        file_put_contents($repositoryPath, $repositoryContent);
    }
}
