<?php
App::uses('SeoAppController', 'Seo.Controller');
class SeoUrlsController extends SeoAppController {

	public function admin_index() {
		$this->Prg->commonProcess($this->SeoUrl->alias, array('action' => 'index'));
		$this->Paginator->settings['conditions']
			= $this->SeoUrl->parseCriteria($this->passedArgs);
		$this->set('seoUrls', $this->Paginator->paginate($this->SeoUrl->alias));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 */
	public function admin_view($id = null) {
		if (!$this->SeoUrl->exists($id)) {
			throw new NotFoundException(__('Invalid seo url'));
		}
		$options = array('conditions' => array('SeoUrl.' . $this->SeoUrl->primaryKey => $id));
		$this->set('seoUrl', $this->SeoUrl->find('first', $options));
	}

	public function admin_add() {
		if ($this->request->is('post')) {
			$this->SeoUrl->create();
			if ($this->SeoUrl->save($this->request->data)) {
				$this->Session->setFlash(__('The seo url has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo url could not be saved. Please, try again.'));
			}
		}
	}

	public function admin_edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid seo url'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->SeoUrl->save($this->request->data)) {
				$this->Session->setFlash(__('The seo url has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo url could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->SeoUrl->findById($id);
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
		$this->SeoUrl->id = $id;
		if (!$this->SeoUrl->exists()) {
			throw new NotFoundException(__('Invalid seo url'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->SeoUrl->delete()) {
			$this->Session->setFlash(__('The seo url has been deleted.'));
		} else {
			$this->Session->setFlash(__('The seo url could not be deleted. Please, try again.'));
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
		$this->SeoUrl->id = $id;
		if (!$this->SeoUrl->exists()) {
			throw new NotFoundException(__('Invalid seo url.'));
		}
		if ($this->SeoUrl->setApproved($id)) {
			$this->Session->setFlash(__('The seo url has been approved.'));
		} else {
			$this->Session->setFlash(__('The seo url could not be approved. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

}
