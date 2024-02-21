<?php

namespace Tnt\Styleguide\Console;

use Oak\Console\Command\Argument;
use Oak\Console\Command\Command;
use Oak\Console\Command\Signature;
use Oak\Contracts\Console\InputInterface;
use Oak\Contracts\Console\OutputInterface;
use Oak\Filesystem\Facade\Filesystem;

class AddCollection extends Command
{
    protected function createSignature(Signature $signature): Signature
    {
        return $signature
            ->setName('add-collection')
            ->setDescription('Add certain styleguide collection by git')
            ->addArgument(Argument::create('repository')->setDescription('The repository (url) of the collection'))
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Clone repository to Resources folder
        shell_exec('git clone '.$input->getArgument('repository').' '.__DIR__.'/../Resources/collection');

        // Sync files
        $directories = Filesystem::directories(__DIR__.'/../Resources/collection');

        foreach ($directories as $directory) {

            foreach (Filesystem::directories($directory) as $d) {

                foreach (Filesystem::files($d) as $file) {

                    $filePath = 'app/templates/styleguide/'.basename($directory).'/'.basename($d).'/'.basename($file);

                    if (! Filesystem::exists($filePath)) {
                        $output->writeLine('move: '.$filePath);
                        Filesystem::move($file, $filePath);
                    }
                }
            }
        }

        // Append styles/js
        $stylePath = 'style/sass/style.scss';
        $jsPath = 'js/app.js';

        if (! $this->stringExistsInFile('../../app/templates/styleguide/atoms/**/*', $stylePath)) {
            $output->writeLine('append styles to : '.$stylePath);
            Filesystem::append($stylePath, PHP_EOL."@import '../../app/templates/styleguide/atoms/all';");
            Filesystem::append($stylePath, PHP_EOL."@import '../../app/templates/styleguide/molecules/all';");
            Filesystem::append($stylePath, PHP_EOL."@import '../../app/templates/styleguide/organisms/all';");
        }

        if (! $this->stringExistsInFile('../app/templates/styleguide/**/*.js', $jsPath)) {
            $output->writeLine('append js to : '.$jsPath);
            Filesystem::append($jsPath, PHP_EOL."import '../app/templates/styleguide/**/*.js';");
        }

        // Remove collection folder
        shell_exec('rm -rf '.__DIR__.'/../Resources/collection');
    }

    private function stringExistsInFile(string $searchFor, $file)
    {
       return strpos(Filesystem::get($file), $searchFor);
    }
}
