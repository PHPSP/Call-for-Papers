<?php

/**
 * Runs through Speakers fixing their twitter handles
 *
 * @package       CfP
 * @subpackage    CfP.shell.tasks
 */
class FixTwitterTask extends Shell {
    var $uses = array('Speaker');

    function execute()
    {
        $speakers = $this->Speaker->find("all");

        foreach($speakers as $user) {
            echo $user['Speaker']['id'] . " [" . $user['User']['email'] . "] ... OK" . PHP_EOL;
            $this->Speaker->save($user['Speaker']);
        }
    }

}
?>