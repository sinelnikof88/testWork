<?php

namespace Commands;

class CounterCommand extends \application\BasicCommand {

    protected $commandName = 'app:counter';

    /**
     *  симфони контроллер для того что бы использовать нормальный роутинг команд - хоть команда и одна но вдруг понадобиться
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @return int
     */
    protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output) {
        /**
         * получаем записи
         */
        $posts = \sinelnikof\model\Post::find()->random()->setLimit(20)->all();
        /**
         * модифицируем переменную coincidenceCount -  в нее будем считать соличество совпадений  userId из выборки
         */
        \sinelnikof\model\CounterPost::coincidenceCount($posts, 'userId', 'coincidenceCount');
        /**
         * ArrayHelper позаимстовал у yii росто хорошая помогалка
         */
        \application\helpers\ArrayHelper::multisort($posts, 'coincidenceCount', SORT_DESC);
        /**
         * может произойти такая ситуация при которой  current($posts) может быть пустым
         * поэтому завернул в трай кейч
         */
        try {
            echo PHP_EOL;
            echo current($posts)->userId;
            echo PHP_EOL;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        /**
         *  требо возвращать код вызова
         */
        return 1;
    }

}
