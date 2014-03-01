<?php
namespace CentralApps\Commands;

class PheanstalkStatsCommand extends AbstractPheanstalkCommand
{
    protected function configure()
    {
        $this
            ->setName('pheanstalk:stats')
            ->setDescription('Stats Tube')
            ->addArgument(
                'tube_name',
                \Symfony\Component\Console\Input\InputArgument::REQUIRED,
                'Which tube do you want to see stats for?'
            );
    }

    protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
    {
        $tube = $input->getArgument('tube_name');
        $data = $this->getPheanstalk()->statsTube($tube);
        $output->writeln("<comment>Details for tube " . $tube . "</comment>");
        foreach ($data as $key => $value) {
            $output->writeln("  <comment>" . $key . "</comment> <info>" . $value . "</info>");
        }
    }
}
