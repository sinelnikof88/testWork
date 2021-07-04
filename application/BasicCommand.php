<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace application;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Description of BasicCommand
 * наследуем команды для того что бы уменьшить количество кода в командах которые будем юзать
 * @author sinelnikof
 */
class BasicCommand extends Command {

    protected $commandName = 'app:default';
    protected $commandDescription = "команда по умаолчанию";
    protected $commandArgumentName = "передоваемый аргумент";
    protected $commandArgumentDescription = "Вопрос к передоваемому аргументу";
    protected $commandOptionName = "cap"; // should be specified like "app:greet John --cap"
    protected $commandOptionDescription = 'If set, it will greet in uppercase letters';

    protected function configure() {
        $this->setName($this->commandName)
                ->setDescription($this->commandDescription)
                ->addArgument($this->commandArgumentName, InputArgument::OPTIONAL, $this->commandArgumentDescription)
                ->addOption($this->commandOptionName, null, InputOption::VALUE_NONE, $this->commandOptionDescription);
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        
    }

}
