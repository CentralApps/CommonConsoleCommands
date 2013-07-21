<?php
namespace CentralApps\Commands;

class PheanstalkFlushCommand extends AbstractPheanstalkCommand
{
	protected function configure()
	{
		$this
			->setName('pheanstalk:flush')
			->setDescription('Flush a tube')
			->addArgument(
				'tube_name',
				\Symfony\Component\Console\Input\InputArgument::REQUIRED,
				'Which tube do you want to flush?'
			);
	}

	protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
	{
		$tube_name = $input->getArgument('tube_name');

		$jobs_count = 0;
		// TODO make these optional with some flags
		$commands = array('peekDelayed', 'peekBuried', 'peekReady');

		foreach ($commands as $command) {
			try {
				while (true) {
					$job = $this->getPheanstalk()->useTube($tube_name)->$command();
					$this->getPheanstalk()->delete($job);
					$jobs_count++;
				}
			} catch (\Exception $e) {

			}
		}

        $output->writeln('<comment>Tube</comment> <info>' . $tube_name . '</info> <comment>flushed.</comment>');
        $output->writeln('<comment>Deleted</comment> <info>' . $jobs_count . '</info> <comment>jobs</comment>');
	}
}