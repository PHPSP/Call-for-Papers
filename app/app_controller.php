<?php
/**
 * Default controller object extended by all other controllers of this app
 *
 * @package default
 * @author Augusto Pascutti
 */
class AppController extends Controller {
	/**
	 * Layout to be used
	 *
	 * @var string
	 */
    public $layout = 'phpconf';
	/**
	 * Components to load in all controllers
	 *
	 * @var string
	 */
    public $components = array('Auth', 'Session', 'Cookie');
    
	/**
	 * Function executed before the method from the controller.
	 *
	 * @see Controller::beforeFilter()
	 * @return void
	 * @author Augusto Pascutti
	 */
    public function beforeFilter() {
        $this->_languageSelect();
        //Configure AuthComponent
		$this->Auth->fields = array(
			'username' => 'email',
			'password' => 'password'
			);
        $this->Auth->loginAction    = '/users/login';
        $this->Auth->logoutRedirect = '/users/index';
        $this->Auth->loginRedirect  = array('controller' => 'proposals', 
                                            'action'     => 'index');
		// Logged var for views
		$logged = (boolean) $this->Session->read('Auth.User');
		$this->set('logged',(int) $logged);
    }
    
    /**
     * Selects the language to be used in the application based on Url route,
     * Cookie or Session configuration.
     *
     * @return void
     * @author Augusto Pascutti
     */
    protected function _languageSelect() {
        $index    = 'PHPSP.Cfp.lang';
        $cookie   = $this->Cookie->read($index);
        $session  = ( $this->Session->check($index) ) ? $this->Session->read($index) : null ;
        $param    = ( isset($this->params['lang']) ) ? $this->params['lang'] : null ;
        $lang     = null;
        $priority = array($param, $session, $cookie, 'por');
        foreach ($priority as $value) {
            if ( empty($value) ) { continue; }
            $lang = $value;
            break;
        }
        Configure::write('Config.language',$lang);
        $this->Session->write($index,$lang);
        $this->Cookie->write($index,$lang);
    }
}