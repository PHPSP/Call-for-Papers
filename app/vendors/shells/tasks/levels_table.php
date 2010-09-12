<?php
/**
 * The 'level' information used to be an ENUM column into the proposals table,
 * this scripts handles the change from the ENUM field to the table.
 *
 * @package       CfP
 * @subpackage    CfP.shell.tasks.
 * @author        Augusto Pascutti
 */
class LevelsTableTask extends Shell {
    var $uses = array('Proposal','Level');
    
    /**
     * Old "level" column name
     *
     * @var string
     */
    var $oldColumn = 'level';
    
    /**
     * Returns the description
     *
     * @return strinf
     * @author Augusto Pascutti
     */
    function desc()
    {
        return "Truncate the levels table and links levels and proposals using the 'levels' table.";
    }

    /**
     * Runs
     *
     * @return void
     * @author Augusto Pascutti
     */
    function run()
    {
        $this->out('Levels table synchronization ....');
        $this->out('');
        $this->out('This will probably destroy the application if you are not aware of these:');
        $this->out(' - This task truncates the "level" table, any row in there will be erased;');
        $this->out(' - This task supposes the database schema is already up-to-date;');
        $this->out(' - Please, do a favor to yourself, and dump your database. AND TEST IT!');
        
        $old_column = $this->oldColumn;
        // Checking if the old column exists
        $speaker = $this->Proposal->find('first');
        if ( ! isset($speaker['Proposal'][$old_column]) ) {
            $this->out('This old column does not exists!');
            return false;
        }
        $this->oldColumn = $old_column;
        // Proceed ?
        $proceed = $this->in('Last chance, still wanna go?', array('y','n'));
        switch ($proceed) {
            case 'n': case 'N':
                exit;
                break;
        }
        
        $methods   = array();
        $methods[] = "_truncateLevelsTable";
        $methods[] = "_populateLevelsTable";
        $methods[] = "_populateNewLevelColumn";
        foreach ($methods as $method) {
            if ( ! method_exists($this,$method) ) { continue; }
            $this->hr();
            $this->$method();
            $this->nl(3);
        }
    }
    
    /**
     * Truncates the sizes table.
     *
     * @return void
     */
    function _truncateLevelsTable()
    {
        $this->out('Truncating "levels" table ....');
        $levels      = $this->Level->find('all');
        foreach ($levels as $level) {
            $id  = $level['Level']['id'];
            $msg = ( $this->Level->delete($id, true) ) ? 'Removed' : 'Error removing' ;
            $this->out('  '.$msg.': '.$id);
        }
    }
    
    /**
     * Gets sizes from the speakers table and populates it to the sizes table.
     *
     * @return void
     * @author Augusto Pascutti
     */
    function _populateLevelsTable()
    {
        $levels      = array();
        $levels['B'] = "Basic";
        $levels['I'] = "Intermediate";
        $levels['A'] = "Advanced";
        
        $this->out("Inserting data into table ....");
        foreach ($levels as $id=>$level) {
            $data = array('Level' => array(
                                "name" => $level,
                                "id"   => $id,
                         ));
            $this->Level->create();
            if ( ! $this->Level->save($data) ) {
                $this->err('Error saving level information');
                exit;
            }
            $this->out('Saved level: '.$level);
        }
    }
    
    /**
     * Populates the size column with the id from the old size column.
     *
     * @return void
     * @author Augusto Pascutti
     */
    function _populateNewLevelColumn()
    {
        $this->out('Gathering information ....');
        $proposals = $this->Proposal->find("all");
        
        // Normalizing array
        $levels      = array();
        $levels['B'] = 1;
        $levels['I'] = 2;
        $levels['A'] = 3;
        
        $this->out('Saving data ...');
        foreach ( $proposals as $proposal ) {
            $old_level = $proposal['Proposal'][$this->oldColumn];
            $level_id  = $levels[$old_level];
            $proposal['Proposal']['level_id'] = $level_id;
            if ( ! $this->Proposal->save($proposal) ) {
                $this->err("Error saving proposal information");
            }
            $this->out('Saved proposal id: '.$proposal['Proposal']['id']);
        }
    }

}