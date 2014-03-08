<?php
App::uses('SeoAppController', 'Seo.Controller');
class SeoUrlsController extends SeoAppController {

	public function admin_index() {
		$this->Prg->commonProcess(null, array('action' => 'index'));
		$this->Paginator->settings['conditions']
			= $this->SeoUrl->parseCriteria($this->passedArgs);
		$this->set('seoUrls', $this->Paginator->paginate($this->SeoUrl->alias));
	}

	public function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid seo url'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('seoUrl', $this->SeoUrl->findById($id));
		$this->set('id', $id);
	}

	public function admin_add() {
		if (!empty($this->request->data)) {
			$this->SeoUrl->clear();
			if ($this->SeoUrl->saveAll($this->request->data)) {
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

	public function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for seo url'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->SeoUrl->delete($id)) {
			$this->Session->setFlash(__('Seo url deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Seo url was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	public function admin_approve($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for seo url'));
		} elseif ($this->SeoUrl->setApproved($id)) {
			$this->Session->setFlash(__('Seo Uri approved'));
		}
		$this->redirect(array('admin' => true, 'action' => 'index'));
	}

}
