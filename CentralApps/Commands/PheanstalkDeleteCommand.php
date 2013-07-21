<?php
namespace CentralApps\Commands;

class PheanstalkDeleteCommand extends AbstractPheanstalkCommand
{
	protected function configure()
	{
		$this
			->setName('pheanstalk:deletejob')
			->setDescription('Delete the first job from a tube')
			->addArgument(
				'tube_name',
				\Symfony\Component\Console\Input\InputArgument::REQUIRED,
				'Which tube do you want to delete a job from?'
			);
	}

	protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
	{
		$tube = $input->getArgument('tube_name');
		try {
			$job = $this->getPheanstalk()->peekReady($tube);
			$this->getPheanstalk()->delete($job);
			$output->writeln("<comment>Job deleted from tube: " . $tube . "</comment>");
		} catch (\Exception $e) {
			$output->writeln('<error>Failed to delete. Perhaps there was no job or tube</error>');
		}
	}
}