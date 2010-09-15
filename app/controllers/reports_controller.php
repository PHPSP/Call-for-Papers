<?php
/**
 * Reports controller
 *
 * @package default
 * @author Augusto Pascutti
 */
class ReportsController extends AppController {
    public $name = "Reports";
    
    public $uses = array('Proposal','Speaker');
    
    public function index() {
        $this->redirect(array('action'=>'summary'));
    }
    
    /**
     * Displays a summary of the current call for papers situation.
     *
     * @return void
     * @author Augusto Pascutti
     */
    public function summary() {
        $all = $this->Speaker->find('all');
        
        $countries          = array();
        $proposals          = 0;
        $proposalsByCountry = array();
        foreach ($all as $speaker) {
            $_country  = $speaker['Speaker']['country'];
            $_proposal = (int) count($speaker['Proposal']);

            // Proposal count
            $proposals += $_proposal;
            
            // Country count
            if ( isset($countries[$_country]) ) {
                $countries[$_country]++;
            } else {
                $countries[$_country]          = 1;
                $proposalsByCountry[$_country] = 0;
            }
            $proposalsByCountry[$_country]    += $_proposal;
            
        }
        $this->set(compact('countries','proposals','proposalsByCountry'));
    }
    
    /**
     * Display the proposals for a given country
     *
     * @return void
     * @author Augusto Pascutti
     */
    public function proposalsByCountry() {
        $country = ( isset($this->params['named']['country']) ) ? $this->params['named']['country'] : null;
        if ( is_null($country) ) {
            $this->Session->setFlash("You need to specify a country!");
            $this->redirect(array('action'=>'summary'));
        }
        $this->Proposal->recursive = 1;
        $speakers                  = $this->Speaker->findAllByCountry($country);
        $quant                     = 0;
        $proposalsCond             = array('Speaker.country'=>$country);
        $proposals                 = $this->paginate('Proposal',$proposalsCond);
        foreach ($speakers as $speaker) {
            $quant    += count($speaker['Proposal']);
        }
        $this->set(compact('country','quant','proposals'));
    }
}