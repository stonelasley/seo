<?php
App::uses('SeoAppController', 'Seo.Controller');
class SeoMetaTagsController extends SeoAppController {

	public function admin_index() {
		$this->Prg->commonProcess($this->SeoMetaTag->alias, array('action' => 'index'));
		$this->Paginator->settings['conditions']
			= $this->SeoMetaTag->parseCriteria($this->passedArgs);
		$this->set('seoMetaTags', $this->Paginator->paginate($this->SeoMetaTag->alias));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 */
	public function admin_view($id = null) {
		if (!$this->SeoMetaTag->exists($id)) {
			throw new NotFoundException(__('Invalid seo meta tag'));
		}
		$options = array('conditions' => array('SeoMetaTag.' . $this->SeoMetaTag->primaryKey => $id));
		$this->set('seoMetaTag', $this->SeoMetaTag->find('first', $options));
	}

	public function admin_add() {
		if ($this->request->is('post')) {
			$this->SeoMetaTag->create();
			if ($this->SeoMetaTag->save($this->request->data)) {
				$this->Session->setFlash(__('The seo meta tag has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo meta tag could not be saved. Please, try again.'));
			}
		}
	}

	public function admin_edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid seo meta tag'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->SeoMetaTag->save($this->request->data)) {
				$this->Session->setFlash(__('The seo meta tag has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo meta tag could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->SeoMetaTag->read(null, $id);
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
		$this->SeoMetaTag->id = $id;
		if (!$this->SeoMetaTag->exists()) {
			throw new NotFoundException(__('Invalid seo meta tag'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->SeoMetaTag->delete()) {
			$this->Session->setFlash(__('The seo meta tag has been deleted.'));
		} else {
			$this->Session->setFlash(__('The seo meta tag could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}