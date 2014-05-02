<?php
App::uses('SeoAppController', 'Seo.Controller');
class SeoRedirectsController extends SeoAppController {

	public function admin_index() {
		$this->Prg->commonProcess($this->SeoRedirect->alias, array('action' => 'index'));
		$this->Paginator->settings['conditions']
			= $this->SeoRedirect->parseCriteria($this->passedArgs);
		$this->set('seoRedirects', $this->Paginator->paginate($this->SeoRedirect->alias));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 */
	public function admin_view($id = null) {
		if (!$this->SeoRedirect->exists($id)) {
			throw new NotFoundException(__('Invalid seo redirect'));
		}
		$options = array('conditions' => array('SeoRedirect.' . $this->SeoRedirect->primaryKey => $id));
		$this->set('seoRedirect', $this->SeoRedirect->find('first', $options));
	}

	public function admin_add() {
		if (!empty($this->request->data)) {
			$this->SeoRedirect->create();
			if ($this->SeoRedirect->save($this->request->data)) {
				$this->Session->setFlash(__('The seo redirect has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo redirect could not be saved. Please, try again.'));
			}
		}
	}

	public function admin_edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid seo redirect'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->SeoRedirect->save($this->request->data)) {
				$this->Session->setFlash(__('The seo redirect has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo redirect could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->SeoRedirect->read(null, $id);
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
		$this->SeoRedirect->id = $id;
		if (!$this->SeoRedirect->exists()) {
			throw new NotFoundException(__('Invalid seo redirect'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->SeoRedirect->delete()) {
			$this->Session->setFlash(__('The seo redirect has been deleted.'));
		} else {
			$this->Session->setFlash(__('The seo redirect could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}