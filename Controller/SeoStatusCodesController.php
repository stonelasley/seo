<?php
App::uses('SeoAppController', 'Seo.Controller');
class SeoStatusCodesController extends SeoAppController {

	public function admin_index() {
		$this->Prg->commonProcess($this->SeoStatusCode->alias, array('action' => 'index'));
		$this->Paginator->settings['conditions']
			= $this->SeoStatusCode->parseCriteria($this->passedArgs);
		$this->set('status_codes', $this->SeoStatusCode->findCodeList());
		$this->set('seoStatusCodes', $this->Paginator->paginate($this->SeoStatusCode->alias));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 */
	public function admin_view($id = null) {
		if (!$this->SeoStatusCode->exists($id)) {
			throw new NotFoundException(__('Invalid seo status code'));
		}
		$options = array('conditions' => array('SeoStatusCode.' . $this->SeoStatusCode->primaryKey => $id));
		$this->set('seoStatusCode', $this->SeoStatusCode->find('first', $options));
	}

	public function admin_add() {
		if ($this->request->is('post')) {
			$this->SeoStatusCode->create();
			if ($this->SeoStatusCode->save($this->request->data)) {
				$this->Session->setFlash(__('The seo status code has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo status code could not be saved. Please, try again.'));
			}
		}
		$this->set('status_codes', $this->SeoStatusCode->findCodeList());
	}

	public function admin_edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid seo status code'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->SeoStatusCode->save($this->request->data)) {
				$this->Session->setFlash(__('The seo status code has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo status code could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->SeoStatusCode->read(null, $id);
		}
		$this->set('status_codes', $this->SeoStatusCode->findCodeList());
		$this->set('id', $id);
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 */
	public function admin_delete($id = null) {
		$this->SeoStatusCode->id = $id;
		if (!$this->SeoStatusCode->exists()) {
			throw new NotFoundException(__('Invalid seo status code'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->SeoStatusCode->delete()) {
			$this->Session->setFlash(__('The seo status code has been deleted.'));
		} else {
			$this->Session->setFlash(__('The seo status code could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}