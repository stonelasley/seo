<?php
App::uses('SeoAppController', 'Seo.Controller');
class SeoTitlesController extends SeoAppController {

	public function admin_index() {
		$this->Prg->commonProcess($this->SeoTitle->alias, array('action' => 'index'));
		$this->Paginator->settings['conditions']
			= $this->SeoTitle->parseCriteria($this->passedArgs);
		$this->set('seoTitles', $this->Paginator->paginate($this->SeoTitle->alias));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 */
	public function admin_view($id = null) {
		if (!$this->SeoTitle->exists($id)) {
			throw new NotFoundException(__('Invalid seoTitle'));
		}
		$options = array('conditions' => array('SeoTitle.' . $this->SeoTitle->primaryKey => $id));
		$this->set('seoTitle', $this->SeoTitle->find('first', $options));
	}

	public function admin_add() {
		if ($this->request->is('post')) {
			$this->SeoTitle->create();
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

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 */
	public function admin_delete($id = null) {
		$this->SeoTitle->id = $id;
		if (!$this->SeoTitle->exists()) {
			throw new NotFoundException(__('Invalid seo title'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->SeoTitle->delete()) {
			$this->Session->setFlash(__('The seo title has been deleted.'));
		} else {
			$this->Session->setFlash(__('The seo title could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}