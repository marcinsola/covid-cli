#!/usr/bin/env php
<?php
require __DIR__ . '/vendor/autoload.php';

use Covid\ApiClient;
use Covid\CovidCommandProcessor;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\SingleCommandApplication;

(new SingleCommandApplication())
    ->setName('Covid')
    ->setVersion('1.0.0')
    ->addArgument('country', InputArgument::OPTIONAL, 'Name of the country that you want to check.', '')
    ->addOption('sort', 's', InputOption::VALUE_OPTIONAL, 'Sort by column', 'cases')
    ->addOption('output', 'o', InputOption::VALUE_OPTIONAL, 'Output format (table/csv/xml/yaml/json', 'table')
    ->setCode(function (InputInterface $input, OutputInterface $output) {
            $apiClient = new ApiClient(new HttpClient());
            $processor = new CovidCommandProcessor($apiClient);

            return $processor->run($input, $output);
    })
    ->run();
