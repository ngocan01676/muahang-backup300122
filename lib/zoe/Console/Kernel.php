<?php
namespace Zoe\Console;
use App\Console\Kernel as ConsoleKernel;
class Kernel extends ConsoleKernel
{
    protected $commands = [
        \Zoe\Console\Commands\MakePlugin::class
    ];
}
