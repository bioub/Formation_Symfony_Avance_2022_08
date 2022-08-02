<?php

namespace App\AliceBundle\Command;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Nelmio\Alice\Loader\SimpleFileLoader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class LoadCommand extends Command
{
    protected static $defaultName = 'alice:load';
    protected static $defaultDescription = 'Loads an Alice YAML file';

    /** @var SimpleFileLoader  */
    protected $fileLoader;

    /** @var EntityManagerInterface */
    protected $manager;

    /**
     * @param SimpleFileLoader $fileLoader
     * @param EntityManagerInterface $manager
     */
    public function __construct(SimpleFileLoader $fileLoader, EntityManagerInterface $manager)
    {
        parent::__construct();
        $this->fileLoader = $fileLoader;
        $this->manager = $manager;
    }

    protected function configure()
    {
        $this->setHelp('You should use this command like this : php bin/console alice:load FILE_PATH');

        $this->addArgument('file-path', InputArgument::REQUIRED, 'The path to the Alice Yaml file');
        $this->addOption('purge', 'p', InputOption::VALUE_NONE, 'Purge the database');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filePath = $input->getArgument('file-path');
        $output->writeln('The file path is : ' . $filePath);

        $purge = $input->getOption('purge');

        if ($purge) {
            $output->writeln('Purging database');
        }

        $set = $this->fileLoader->loadFile($filePath);

        foreach ($set->getObjects() as $object) {
            $this->manager->persist($object);
        }

        $this->manager->flush();

        $output->writeln('Inserted ' . count($set->getObjects()) . ' entities');

        return Command::SUCCESS;
    }
}