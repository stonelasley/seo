<?php
App::uses('SeoAppController', 'Seo.Controller');
class SeoCanonicalsController extends SeoAppController {

	public function admin_index() {
		$this->Prg->commonProcess($this->SeoCanonical->alias, array('action' => 'index'));
		$this->Paginator->settings['conditions']
			= $this->SeoCanonical->parseCriteria($this->passedArgs);
		$this->set('seoCanonicals', $this->Paginator->paginate($this->SeoCanonical->alias));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 */
	public function admin_view($id = null) {
		if (!$this->SeoCanonical->exists($id)) {
			throw new NotFoundException(__('Invalid seo canonical'));
		}
		$options = array('conditions' => array('SeoCanonical.' . $this->SeoCanonical->primaryKey => $id));
		$this->set('seoCanonical', $this->SeoCanonical->find('first', $options));
	}

	public function admin_add() {
		if ($this->request->is('post')) {
			$this->SeoCanonical->create();
			if ($this->SeoCanonical->save($this->request->data)) {
				$this->Session->setFlash(__('The seo canonical has been saved'));
				return $this->redirect(array('action' => 'index'));
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

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 */
	public function admin_delete($id = null) {
		$this->SeoCanonical->id = $id;
		if (!$this->SeoCanonical->exists()) {
			throw new NotFoundException(__('Invalid seo canonical'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->SeoCanonical->delete()) {
			$this->Session->setFlash(__('The seo canonical has been deleted.'));
		} else {
			$this->Session->setFlash(__('The seo canonical could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

}
