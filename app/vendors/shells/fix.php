<?php
/**
 * Shell to execute Fix tasks
 *
 * @package       CfP
 * @subpackage    CfP.shell
 */
class FixShell extends Shell {
    var $tasks = array('FixTwitter','SizesTable','LevelsTable','Groups');

    /**
     * Init of the shell
     *
     * @return void
     * @author Augusto Pascutti
     */
    function main() 
    {
        $this->menu();
    }
    
    /**
     * Gets a description for the given task.
     * This methods requires that the task has a "desc()" method declared 
     * within it.
     *
     * @param string $name 
     * @return string
     * @author Augusto Pascutti
     */
    function _getTaskDescription($name)
    {
        if ( method_exists($this->$name,'desc') ) {
            return $this->$name->desc();
        }
        return "Description not available";
    }
    
    /**
     * Displays a menu
     *
     * @return void
     * @author Augusto Pascutti
     */
    function menu()
    {
        
        $this->out('Call for Papers - Console Utility');
        $this->out();
        $this->out('We currently have the following tasks:');
        $options = array('q');
        foreach ($this->tasks as $id=>$name) {
            $this->out(" [{$id}] {$name}");
            $this->out("         ".$this->_getTaskDescription($name));
            $options[] = $id;
        }
        $this->out(' [q] Quits this console');
        $option = $this->in("What task you want to run?",$options);
        var_dump($option);
        switch ($option) {
            case 'q': case 'Q':
                exit;
                break;
            default:
                $option = (int) $option;
                $task   = $this->tasks[$option];
                $this->$task->run();
                break;
        }
    }
    
    
}
