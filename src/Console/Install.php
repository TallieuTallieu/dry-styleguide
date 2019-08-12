<?php

namespace Tnt\Styleguide\Console;

use Oak\Console\Command\Command;
use Oak\Console\Command\Signature;
use Oak\Contracts\Console\InputInterface;
use Oak\Contracts\Console\OutputInterface;
use Oak\Filesystem\Facade\Filesystem;

class Install extends Command
{
	protected function createSignature(Signature $signature): Signature
	{
		return $signature
			->setName('install')
			->setDescription('Installs the styleguide')
			;
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		// Copy the assets
		$files = Filesystem::files(__DIR__.'/../Resources/sass');
		$partials = Filesystem::files(__DIR__.'/../Resources/sass/styleguide_partials');

		foreach ($files as $file) {
			$basename = basename($file);
			$output->writeLine('Copying '.$basename.' to style/sass/');
			Filesystem::copy($file, 'style/sass/'.$basename);
		}

		foreach ($partials as $partial) {
			$basename = basename($partial);
			$output->writeLine('Copying '.$basename.' to style/sass/');
			Filesystem::copy($partial, 'style/sass/styleguide_partials/'.$basename);
		}

		$output->writeLine('Styleguide installation completed', OutputInterface::TYPE_INFO);
	}
}