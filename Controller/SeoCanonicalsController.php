<?php
App::uses('SeoAppController', 'Seo.Controller');
class SeoCanonicalsController extends SeoAppController {

	public function admin_index() {
		$this->Prg->commonProcess($this->SeoCanonical->alias, array('action' => 'index'));
		$this->Paginator->settings['conditions']
			= $this->SeoCanonical->parseCriteria($this->passedArgs);
		$this->set('seoCanonicals', $this->Paginator->paginate($this->SeoCanonical->alias));
	}

	public function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid seo canonical'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('seoCanonical', $this->SeoCanonical->read(null, $id));
	}

	public function admin_add() {
		if (!empty($this->request->data)) {
			$this->SeoCanonical->clear();
			if ($this->SeoCanonical->save($this->request->data)) {
				$this->Session->setFlash(__('The seo canonical has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo canonical could not be saved. Please, try again.'));
			}
		}
	}

	public function admin_edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid seo canonical'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->SeoCanonical->save($this->request->data)) {
				$this->Session->setFlash(__('The seo canonical has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo canonical could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->SeoCanonical->read(null, $id);
		}
	}

	public function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for seo canonical'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->SeoCanonical->delete($id)) {
			$this->Session->setFlash(__('Seo canonical deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Seo canonical was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
