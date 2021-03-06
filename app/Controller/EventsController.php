<?php
App::uses('AppController', 'Controller');

class EventsController extends AppController {

	public function index() {
		$this->Event->recursive = 0;
		$this->set('events', $this->Paginator->paginate());
	}

	public function view($id = null) {
		if (!$this->Event->exists($id)) {
			throw new NotFoundException(__('Invalid event'));
		}
		$options = array('conditions' => array('Event.' . $this->Event->primaryKey => $id));
		$this->set('event', $this->Event->find('first', $options));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Event->create();
			if ($this->Event->save($this->request->data)) {
				$this->Session->setFlash(__('The event has been saved.'), 'message_success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event could not be saved. Please, try again.'), 'message_error');
			}
		}
		$editions = $this->Event->Edition->find('list');
		$places = $this->Event->Place->find('list');
		$tags = $this->Event->Tag->find('list');
		$this->set(compact('editions', 'places', 'tags'));
	}

	public function edit($id = null) {
		if (!$this->Event->exists($id)) {
			throw new NotFoundException(__('Invalid event'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Event->save($this->request->data)) {
				$this->Session->setFlash(__('The event has been saved.'), 'message_success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event could not be saved. Please, try again.'), 'message_error');
			}
		} else {
			$options = array('conditions' => array('Event.' . $this->Event->primaryKey => $id));
			$this->request->data = $this->Event->find('first', $options);
		}
		$editions = $this->Event->Edition->find('list');
		$places = $this->Event->Place->find('list');
		$tags = $this->Event->Tag->find('list');
		$this->set(compact('editions', 'places', 'tags'));
	}

	public function delete($id = null) {
		$this->Event->id = $id;
		if (!$this->Event->exists()) {
			throw new NotFoundException(__('Invalid event'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Event->delete()) {
			$this->Session->setFlash(__('The event has been deleted.'), 'message_success');
		} else {
			$this->Session->setFlash(__('The event could not be deleted. Please, try again.'), 'message_error');
		}
		return $this->redirect(array('action' => 'index'));
	}
	public function participate($id = null){
		$this->Event->id = $id;
		if (!$this->Event->exists()) {
			throw new NotFoundException(__('Invalid event'));	
		}
		$participant = array(
			'Participant' => array(
				'event_id' => $id,
				'user_id' => $this->Auth->user('id')
			)
		);
		if ($this->Event->Participant->save($participant)) {
			$this->Session->setFlash(__('Your participation to this event has been saved.'), 'message_success');
		} else {
			$this->Session->setFlash(__('Your participation to this event could not been saved. Please, try again.'), 'message_error');
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function feed(){
		$events = $this->Event->find('all', array(
			'contain' => array(),
			'limit' => 10,
			'order' => array('Event.created' => 'DESC'),
		));
		$this->set(compact('events'));
		$this->RequestHandler->renderAs($this, 'rss');
	}

	public function event24h(){
		$tomorow = date('Y-m-d', strtotime('+1 day'
		));
		$twitter = new Endroid\Twitter\Twitter(
			"W8CeK0fCIeSHyk9nWvQiOdre8",
			"H6Y5AOlDu4sbYM4ezgmMbzP1yVGvNLeYUtwoAubcGYkabYNa8H",
			"321403621-Bp5GYmQc5sAQHGdIEtqfuzWhyvIKMyxxMM4Mv8M8",
			"n0uaIeTWDXNz0unsVgEpj7f8WsbzscPusOIgD7PaUbryK");
		$events = $this->Paginator->paginate('Event',  array(
			'Event.start_at >=' => $tomorow
		));
		$this->set(compact('events'));
	}

}
