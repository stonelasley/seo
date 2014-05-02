<?php
App::uses('SeoAppController', 'Seo.Controller');
class SeoUrisController extends SeoAppController {

	public function admin_index() {
		$this->Prg->commonProcess($this->SeoUri->alias, array('action' => 'index'));
		$this->Paginator->settings['conditions']
		= $this->SeoUri->parseCriteria($this->passedArgs);
		$this->set('seoUris', $this->Paginator->paginate($this->SeoUri->alias));
	}

/**
 * admin_urlencode method
 *
 * @throws NotFoundException
 * @param string $id
 */
	public function admin_urlencode($id = null) {
		if (!$this->SeoUri->exists($id)) {
			throw new NotFoundException(__('Invalid seo uri.'));
		}
		if ($this->SeoUri->urlEncode($id)) {
			$this->Session->setFlash(__('The seo uri has been encoded sucessfully.'));
		} else {
			$this->Session->setFlash(__('The seo uri could not be encoded. Please, try again.'));
		}
		return $this->redirect(array('action' => 'view', $id));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 */
	public function admin_view($id = null) {
		if (!$this->SeoUri->exists($id)) {
			throw new NotFoundException(__('Invalid seo uri.'));
		}
		$options = array('conditions' => array('SeoUri.' . $this->SeoUri->primaryKey => $id));
		$this->set('seoUri', $this->SeoUri->find('first', $options));
	}

	public function admin_add() {
		if ($this->request->is('post')) {
			$this->SeoUri->create();
			if ($this->SeoUri->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The seo uri has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo uri could not be saved. Please, try again.'));
			}
		}
	}

	public function admin_edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid seo uri.'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->SeoUri->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The seo uri has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo uri could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->SeoUri->findForViewById($id);
		}
		$this->set('status_codes', $this->SeoUri->SeoStatusCode->findCodeList());
		$this->set('id', $id);
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 */
	public function admin_delete($id = null) {
		$this->SeoUri->id = $id;
		if (!$this->SeoUri->exists()) {
			throw new NotFoundException(__('Invalid seo uri.'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->SeoUri->delete()) {
			$this->Session->setFlash(__('The seo uri has been deleted.'));
		} else {
			$this->Session->setFlash(__('The seo uri could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_approve method
 *
 * @throws NotFoundException
 * @param string $id
 */
	public function admin_approve($id = null) {
		$this->SeoUri->id = $id;
		if (!$this->SeoUri->exists()) {
			throw new NotFoundException(__('Invalid seo uri.'));
		}
		if ($this->SeoUri->setApproved($id)) {
			$this->Session->setFlash(__('The seo uri has been approved.'));
		} else {
			$this->Session->setFlash(__('The seo uri could not be approved. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}