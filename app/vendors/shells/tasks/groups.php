<?php
/**
 * Truncates the groups table, added the default groups and assign them 
 * to the current users.
 *
 * @package       CfP
 * @subpackage    CfP.shell.tasks
 * @author        Augusto Pascutti
 */
class GroupsTask extends Shell {
    var $uses = array('User','Group');

    /**
     * Description of this task
     *
     * @return string
     */
    public function desc()
    {
        return "Truncates the groups table, added the default groups and assign them to the current users";
    }

    /**
     * Executes the task
     *
     * @return void
     */
    public function run()
    {
        $this->out("Group creation and synchronization ....");
        $this->hr();
        $in = $this->in('This will truncate current groups table, are you sure?', array('y','n'));
        switch ($in) {
            case 'n': case 'N':
                exit;
                break;
        }
        
        $methods   = array();
        $methods[] = "_truncateTable";
        $methods[] = "_populateTable";
        $methods[] = "_assignUsersToGroup";
        foreach ($methods as $method) {
            if ( ! method_exists($this,$method) ) { continue; }
            $this->hr();
            $this->$method();
            $this->nl(3);
        }
    }

    /**
     * Truncates groups table.
     *
     * @return void
     * @author Augusto Pascutti
     */
    public function _truncateTable() {
        $this->out('Truncation groups table ...');
        $groups = $this->Group->find('all');
        foreach($groups as $group) {
            $id = $group['Group']['id'];
            $ok = ( $this->Group->delete($id, true) ) ? "ok" : "err" ;
            $this->out("Removind ID {$id} {$ok}");
            if ( $ok == 'err' ) { 
                $this->err("Unknown error removing group ...");
            }
            $this->out('.',0);
        }
        $this->out('done.');
    }
    
    /**
     * Populates Groups table
     *
     * @return void
     * @author Augusto Pascutti
     */
    public function _populateTable() {
        $this->out('Populating table ...');
        $groups = array('Administrators', 'Speakers');
        
        foreach ($groups as $group) {
            $this->Group->create();
            $data = array('Group' => array('name'=>$group));
            if ( ! $this->Group->save($data) ) {
                $this->err("Error saving group!");
            }
            $this->out('.',0);
        }
        $this->out('done');
    }
    
    /**
     * Retrieves the Speakers group and sets it to the existing users.
     *
     * @return void
     * @author Augusto Pascutti
     */
    public function _assignUsersToGroup() {
        $this->out('Assigning "Speaker" group to all current users ...');
        
        $group = $this->Group->findByName('Speakers');
        if ( empty($group) || count($group) <= 0 ) {
            $this->err('Could not find "Speakers" group ...');
        }
        $group_id = $group['Group']['id'];
        
        if ( empty($group_id) ) {
            $this->err('Unknown error finding "Speakers" group ...');
        }
        
        $users = $this->User->find('all');
        foreach ($users as $user) {
            $user['User']['group_id'] = $group_id;
            if ( ! $this->User->save($user) ) {
                $this->err('Error saving user ...');
            }
            $this->out('.', 0);
        }
        $this->out('done.');
    }
}