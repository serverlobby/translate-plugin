<?php namespace Rainlab\Translate\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use RainLab\Translate\Classes\ThemeScanner;
use RainLab\Translate\Models\Message;

class ScanCommand extends Command
{
    protected $name = 'translate:scan';

    protected $description = 'Scan theme localizations files for new messages.';

    public function handle()
    {
        if ($this->option('purge')) {
            $this->output->writeln('Purging messages...');
            Message::truncate();
        }

        ThemeScanner::scan();
        $this->output->success('Messages scanned successfully.');
    }

    protected function getArguments()
    {
        return [];
    }

    protected function getOptions()
    {
        return [
            ['purge', 'null', InputOption::VALUE_NONE, 'First purge existing messages.', null],
        ];
    }
}