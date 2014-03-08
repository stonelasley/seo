<?php
App::uses('SeoAppController', 'Seo.Controller');
class SeoTitlesController extends SeoAppController {

	public function admin_index() {
		$this->Prg->commonProcess($this->SeoTitle->alias, array('action' => 'index'));
		$this->Paginator->settings['conditions']
			= $this->SeoTitle->parseCriteria($this->passedArgs);
		$this->set('seoTitles', $this->Paginator->paginate($this->SeoTitle->alias));
	}

	public function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid seo title'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('seoTitle', $this->SeoTitle->read(null, $id));
	}

	public function admin_add() {
		if (!empty($this->request->data)) {
			$this->SeoTitle->clear();
			if ($this->SeoTitle->save($this->request->data)) {
				$this->Session->setFlash(__('The seo title has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo title could not be saved. Please, try again.'));
			}
		}
		$seoUris = $this->SeoTitle->SeoUri->find('list');
		$this->set(compact('seoUris'));
	}

	public function admin_edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid seo title'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->SeoTitle->save($this->request->data)) {
				$this->Session->setFlash(__('The seo title has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo title could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->SeoTitle->read(null, $id);
		}
		$seoUris = $this->SeoTitle->SeoUri->find('list');
		$this->set(compact('seoUris'));
	}

	public function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for seo title'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->SeoTitle->delete($id)) {
			$this->Session->setFlash(__('Seo title deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Seo title was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}