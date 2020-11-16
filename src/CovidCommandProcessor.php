<?php

namespace Covid;

use InvalidArgumentException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CovidCommandProcessor
{
    public function __construct(ApiClient $apiClient)
    {
        //@TODO: Use proper symfony dependency injection
        $this->apiClient = $apiClient;
        $this->resultSorter = new ResultSorter();
        $this->outputRenderer = new OutputRenderer();
    }

    public function run(InputInterface $input, OutputInterface $output): bool
    {
        try {
            $result = $this->apiClient->getData($input->getArgument('country'));
            $result = $this->resultSorter->sort($result, $input->getOption('sort'));

            $format = $input->getOption('output');
            $this->outputRenderer->render($result, $output, $input->getOption('output'));

            return Command::SUCCESS;
        } catch (InvalidArgumentException $e) {
            $output->write("<error>{$e->getMessage()}</error>");

            return Command::FAILURE;
        }
    }
}
