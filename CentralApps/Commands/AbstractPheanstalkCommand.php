<?php
namespace CentralApps\Commands;

abstract class AbstractPheanstalkCommand extends \Symfony\Component\Console\Command\Command implements AcceptsContainerInterface
{
	protected $container;

	public function setContainer($container)
	{
		if (!is_array($container) && ! ($container instanceof \ArrayAccess)) {
			throw new \InvalidArgumentException("Container must either be an array or implement \ArrayAccess");
		}

		$this->container = $container;
	}

	protected function getPheanstalk()
	{
		return $this->container['pheanstalk'];
	}
}