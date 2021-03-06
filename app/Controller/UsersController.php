<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

	var $name = 'Users';

	
/**
 * login method
 *
 * @return void
 */
	function login() {
	    //-- code inside this function will execute only when autoRedirect was set to false (i.e. in a beforeFilter).
		$this->layout = 'login';
		$this->set('title_for_layout','Login');
		// $this->set('css_for_layout',array('formularios','pages_view'));

	    if ($this->request->is('post')) {
			// print_r($this->request->data);exit();
	        if ($this->Auth->login()) {
	            $UserAuth = $this->Auth->user();
	            $this->Session->write('UserAuth',$UserAuth);
	            
	            return $this->redirect($this->Auth->redirect());
	        } else {
	            $this->Session->setFlash(__('O nome de usuário ou a senha inserido está incorreto.'), 'default', array(), 'auth');
	        }
	    }

		
		/*
	    if ($this->Auth->user()) { //Se estiver logado, cria o cookie
	    	//$this->Session->write('Usercategoria', array('entrou no primeiro IF'));
	        
	        //$this->Session->write('User', $dbuser);// write the username to a session
			$this->Session->write('UserInfo', $this->User->find('all',array('conditions'=>array('User.id'=>$this->Auth->user('id')))));
			$this->User->id = $this->Auth->user('id');
			$this->User->saveField('lastaccess',date("Y-m-d H:i:s"));// save the login time

			$this->Session->setFlash('Seja bem vindo!');// redirect the user


	        if (!empty($this->data) && ($this->data['User']['remember_me']=='1')) {
	            $cookie = array();
	            $cookie['username'] = $this->data['User']['login'];
	            $cookie['password'] = $this->data['User']['senha'];
	            $this->Cookie->write('Auth.User', $cookie, true, '+2 weeks');
	            unset($this->data['User']['remember_me']);
	        }
	        $this->redirect($this->Auth->redirect());
	    }

	    if (empty($this->data)) { //Se tentar acessar a página, e o cookie existir, libera o acesso
	    	//$this->Session->write('Usercategoria', array('entrou no segundo IF'));
	        $cookie = $this->Cookie->read('Auth.User');
	        if (!is_null($cookie)) {
	            if ($this->Auth->login($cookie)) {
	                //  Clear auth message, just in case we use it.
	                $this->Session->delete('Message.auth');
	                $this->redirect($this->Auth->redirect());
	            } else { // Delete invalid Cookie
	                $this->Cookie->delete('Auth.User');
	            }
	        }
	    }*/
	}

	public function logout() {
		if ($this->Session->valid()) {
			$this->Session->destroy(); // Exclui todas as sessões ativas
		}
		// $this->Cookie->delete('Auth.User');

	    $this->redirect($this->Auth->logout());
	}

	function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('%s inválido.', true), 'User'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(sprintf(__('O %s foi salvo.', true), 'user'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('O %s não pode ser salvo. Por favor, tente novamente.', true), 'user'));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('%s inválido.', true), 'User'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(sprintf(__('O %s foi salvo.', true), 'user'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('O %s não pode ser salvo. Por favor, tente novamente.', true), 'user'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('ID inválido para %s.', true), 'user'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s excluído.', true), 'User'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('%s não pode ser excluído.', true), 'User'));
		$this->redirect(array('action' => 'index'));
	}
}
?>