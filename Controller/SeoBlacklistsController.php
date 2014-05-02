<?php
App::uses('SeoAppController', 'Seo.Controller');
class SeoBlacklistsController extends SeoAppController {

	public function beforeFilter() {
		parent::beforeFilter();
		if (isset($this->Auth)) {
			$this->Auth->allow('banned');
		}
	}

/**
 * Banned action
 */
	public function banned() {
		$this->layout = 'banned';
	}

/**
 * Admin actions
 */
	public function admin_index() {
		$this->Prg->commonProcess($this->SeoBlacklist->alias, array('action' => 'index'));
		$this->Paginator->settings['conditions']
			= $this->SeoBlacklist->parseCriteria($this->passedArgs);
		$this->set('seoBlacklists', $this->Paginator->paginate($this->SeoBlacklist->alias));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 */
	public function admin_view($id = null) {
		if (!$this->SeoBlacklist->exists($id)) {
			throw new NotFoundException(__('Invalid seo blacklist'));
		}
		$options = array('conditions' => array('SeoBlacklist.' . $this->SeoBlacklist->primaryKey => $id));
		$this->set('seoBlacklist', $this->SeoBlacklist->find('first', $options));
	}

	public function admin_add() {
		if ($this->request->is('post')) {
			$this->SeoBlacklist->create();
			if ($this->SeoBlacklist->save($this->request->data)) {
				$this->Session->setFlash(__('The seo blacklist has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo blacklist could not be saved. Please, try again.'));
			}
		}
	}

	public function admin_edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid seo blacklist'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->SeoBlacklist->save($this->request->data)) {
				$this->Session->setFlash(__('The seo blacklist has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo blacklist could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->SeoBlacklist->read(null, $id);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 */
	public function admin_delete($id = null) {
		$this->SeoBlacklist->id = $id;
		if (!$this->SeoBlacklist->exists()) {
			throw new NotFoundException(__('Invalid seo blacklist'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->SeoBlacklist->delete()) {
			$this->Session->setFlash(__('The seo blacklist has been deleted.'));
		} else {
			$this->Session->setFlash(__('The seo blacklist could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}