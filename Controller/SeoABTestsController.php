<?php
App::uses('SeoAppController', 'Seo.Controller');
class SeoABTestsController extends SeoAppController {

	public $paginate = array(
		'order' => 'SeoABTest.created DESC'
	);

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('slots', $this->SeoABTest->slots);
	}

	public function admin_index() {
		$this->Prg->commonProcess(null, array('action' => 'index'));
		$this->Paginator->settings['conditions']
			= $this->SeoABTest->parseCriteria($this->passedArgs);
		$this->set('seoABTests', $this->Paginator->paginate($this->SeoABTest->alias));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 */
	public function admin_view($id = null) {
		if (!$this->SeoABTest->exists($id)) {
			throw new NotFoundException(__('Invalid seo AB Test'));
		}
		$options = array('conditions' => array('SeoABTest.' . $this->SeoABTest->primaryKey => $id));
		$this->set('seoABTest', $this->SeoABTest->find('first', $options));
	}

	public function admin_add() {
		if ($this->request->is('post')) {
			$this->SeoABTest->create();
			if ($this->SeoABTest->save($this->request->data)) {
				$this->Session->setFlash(__('The seo AB Test has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo AB Test could not be saved. Please, try again.'));
			}
		}
	}

	public function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid seo AB Test'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SeoABTest->save($this->data)) {
				$this->Session->setFlash(__('The seo AB Test has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo AB Test could not be saved. Please, try again.'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SeoABTest->read(null, $id);
		}
		$this->set('id', $id);
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 */
	public function admin_delete($id = null) {
		$this->SeoABTest->id = $id;
		if (!$this->SeoABTest->exists()) {
			throw new NotFoundException(__('Invalid seo AB Test'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->SeoABTest->delete()) {
			$this->Session->setFlash(__('The seo AB Test has been deleted.'));
		} else {
			$this->Session->setFlash(__('The seo AB Test could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}