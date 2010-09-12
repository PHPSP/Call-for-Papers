<?php
/**
 * The 'size' information used to be an ENUM column into the speakers table,
 * this scripts handles the change from the ENUM field to the table.
 *
 * @package       CfP
 * @subpackage    CfP.shell.tasks.
 * @author        Augusto Pascutti
 */
class SizesTableTask extends Shell {
    var $uses = array('Speaker','Size');
    
    /**
     * Old "size" column name
     *
     * @var string
     */
    var $oldColumn = 'size';
    
    /**
     * Returns the description
     *
     * @return strinf
     * @author Augusto Pascutti
     */
    function desc()
    {
        return "Truncate the sizes table, gets the size from one column and puts in another.";
    }

    /**
     * Runs
     *
     * @return void
     * @author Augusto Pascutti
     */
    function run()
    {
        $this->out('Sizes table synchronization ....');
        $this->out('');
        $this->out('This will probably destroy the application if you are not aware of these:');
        $this->out(' - This task truncates the "sizes" table, any row in there will be erased;');
        $this->out(' - This task supposes the database schema is already up-to-date;');
        $this->out(' - The "size" column information in "speakers" table will be replaced by an ID (int);');
        $this->out(' - The "OLD COLUMN" is an column YOU should create with the size selected by the speaker. Usually, this is the old "sizes" column. Hint, rename it;');
        $this->out(' - Please, do a favor to yourself, and dump your database. AND TEST IT!');
        
        //$old_column = $this->in('Please, what is the name of the OLD COLUMN?');
        $old_column = $this->oldColumn;
        // Checking if the old column exists
        $speaker = $this->Speaker->find('first');
        if ( ! isset($speaker['Speaker'][$old_column]) ) {
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
        $methods[] = "_truncateSizesTable";
        $methods[] = "_populateSizesTable";
        $methods[] = "_populateNewSizeColumn";
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
    function _truncateSizesTable()
    {
        $this->out('Truncating "sizes" table ....');
        $sizes      = $this->Size->find('all');
        foreach ($sizes as $size) {
            $id  = $size['Size']['id'];
            $msg = ( $this->Size->delete($id, true) ) ? 'Removed' : 'Error removing' ;
            $this->out('  '.$msg.': '.$id);
        }
    }
    
    /**
     * Gets sizes from the speakers table and populates it to the sizes table.
     *
     * @return void
     * @author Augusto Pascutti
     */
    function _populateSizesTable()
    {
        $this->out('Gathering current "size" column information from old column ...');
        $speakers = $this->Speaker->find("all");
        $sizes    = array();
        foreach ($speakers as $speaker) {
            $size = $speaker['Speaker'][$this->oldColumn];
            $sizes[$size] = $size;
        }
        ksort($sizes,SORT_STRING);
        $this->out("Inserting data into table ....");
        $key = 1;
        foreach ($sizes as $size) {
            $data = array('Size' => array(
                            "description" => $size,
                            "id" => $key++,
                         ));
            $this->Size->create();
            if ( ! $this->Size->save($data) ) {
                $this->err('Error saving size information');
                exit;
            }
            $this->out('Saved size: '.$size);
        }
    }
    
    /**
     * Populates the size column with the id from the old size column.
     *
     * @return void
     * @author Augusto Pascutti
     */
    function _populateNewSizeColumn()
    {
        $this->out('Gathering information ....');
        $speakers = $this->Speaker->find("all");
        $_sizes   = $this->Size->find('all');
        $sizes    = array();
        
        // Normalizing array
        foreach ( $_sizes as $size ) {
            $id  = $size['Size']['id'];
            $val = $size['Size']['description'];
            $sizes[$id] = $val;
        }
        $sizes = array_flip($sizes);
        
        $this->out('Saving data ...');
        foreach ( $speakers as $speaker ) {
            $old_size = $speaker['Speaker'][$this->oldColumn];
            $size_id  = $sizes[$old_size];
            $speaker['Speaker']['size_id'] = $size_id;
            if ( ! $this->Speaker->save($speaker) ) {
                $this->err("Error saving speaker information");
            }
            $this->out('Saved speaker id: '.$speaker['Speaker']['id']);
        }
    }

}