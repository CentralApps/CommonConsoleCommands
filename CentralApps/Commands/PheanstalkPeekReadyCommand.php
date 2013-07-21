<?php
namespace CentralApps\Commands;

class PheanstalkPeekReadyCommand extends AbstractPheanstalkCommand
{
	protected function configure()
	{
		$this
			->setName('pheanstalk:peekready')
			->setDescription('Peek ready a tube')
			->addArgument(
				'tube_name',
				\Symfony\Component\Console\Input\InputArgument::REQUIRED,
				'Which tube do you want to see peek ready?'
			);
	}

	protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
	{
		$tube = $input->getArgument('tube_name');
		$data = $this->getPheanstalk()->peekReady($tube);
		$output->writeln("<comment>Peek Ready in tube " . $tube . "</comment>");
		$output->writeln("<comment> Job id:</comment><info> " . $data->getId() . "</info>");
		$output->writeln("<comment> Job payload:</comment><info> " . print_r($data->getData(), true) . "</info>");
	}
}