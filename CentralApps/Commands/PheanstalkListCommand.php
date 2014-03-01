<?php
namespace CentralApps\Commands;

class PheanstalkListCommand extends AbstractPheanstalkCommand
{
    protected function configure()
    {
        $this
            ->setName('pheanstalk:list')
            ->setDescription('List tubes');
    }

    protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
    {
        $data = $this->getPheanstalk()->listTubes();
        $output->writeln("<comment>Tubes</comment>");
        foreach ($data as $tube) {
            $output->writeln("<info> " . $tube . "</info>");
        }
    }
}
