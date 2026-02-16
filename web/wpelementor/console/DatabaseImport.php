<?php

namespace Codevelopers\Fullstack\Console;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use function Codevelopers\Fullstack\Env\get_env;

class DatabaseImport extends Command
{
    protected static $defaultName = 'database:import';
    protected $config;
    protected $fileName;

    public function __construct()
    {
        parent::__construct();
        $this->config = (object) [
            'host' => get_env('DB_HOST'),
            'database' => get_env('DB_NAME'),
            'user' => get_env('DB_USER'),
            'password' => get_env('DB_PASSWORD'),
        ];
        $this->fileName = null;
    }

    private function getSqlFile()
    {
        $finder = new Finder();
        $finder
            ->files()
            ->in(__DIR__ . '/../database')
            ->name('*.sql')
            ->reverseSorting()
            ->sortByName();

        if ($finder->hasResults()) {
            foreach ($finder as $file) {
                return $file->getRealPath();
            }
        }

        return null;
    }

    protected function configure()
    {
        $help = 'Import the entire database from an .sql file stored in the database folder.' . PHP_EOL . 'By default the imported file is wich has the last modified time.';

        $this->setDescription('Import the entire database from an sql file')
            ->setHelp($help)
            ->addArgument('file-input', InputArgument::OPTIONAL, 'Input sql filename');
    }

    private function executeImportProcess(OutputInterface $output)
    {
        $cmd = sprintf(
            'mysql -h%s -u%s %s --skip-ssl --default-character-set=utf8mb4 %s < %s',
            escapeshellarg($this->config->host),
            escapeshellarg($this->config->user),
            $this->config->password ?
                '-p' . escapeshellarg($this->config->password) : '',
            escapeshellarg($this->config->database),
            escapeshellarg($this->fileName)
        );

        $process = new Process($cmd);
        $process->run();

        if (!$process->isSuccessful()) {
            $output->writeln([
                '<error>',
                'Error importing database:',
                $process->getErrorOutput(),
                '</error>',
            ]);

            return false;
        }

        return true;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($input->getArgument('file-input')) {
            $this->fileName = __DIR__ . '/../database/' . $input->getArgument('file-input');
        } else {
            $this->fileName = $this->getSqlFile();
        }

        if (!$this->executeImportProcess($output)) {
            return false;
        }
        $output->writeln([
            '',
            '<info>Database imported successfully from ' . basename($this->fileName) . '</info>',
        ]);
    }
}
