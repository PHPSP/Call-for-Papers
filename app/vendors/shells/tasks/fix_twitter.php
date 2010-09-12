<?php
/**
 * Runs through Speakers fixing their twitter handles
 *
 * @package       CfP
 * @subpackage    CfP.shell.tasks
 * @author        Rafael Dohms
 */
class FixTwitterTask extends Shell {
    var $uses = array('Speaker');

    /**
     * Description of this task
     *
     * @return string
     */
    function desc()
    {
        return "Runs through Speakers fixing their twitter handles";
    }

    /**
     * Executes the task
     *
     * @return void
     */
    function run()
    {
        $speakers = $this->Speaker->find("all");

        foreach($speakers as $user) {
            echo $user['Speaker']['id'] . " [" . $user['User']['email'] . "] ... OK" . PHP_EOL;
            $this->Speaker->save($user['Speaker']);
        }
    }

}