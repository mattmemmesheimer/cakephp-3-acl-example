<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Widgets Controller
 *
 * @property \App\Model\Table\WidgetsTable $Widgets
 */
class WidgetsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('widgets', $this->paginate($this->Widgets));
        $this->set('_serialize', ['widgets']);
    }

    /**
     * View method
     *
     * @param string|null $id Widget id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $widget = $this->Widgets->get($id, [
            'contain' => []
        ]);
        $this->set('widget', $widget);
        $this->set('_serialize', ['widget']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $widget = $this->Widgets->newEntity();
        if ($this->request->is('post')) {
            $widget = $this->Widgets->patchEntity($widget, $this->request->data);
            if ($this->Widgets->save($widget)) {
                $this->Flash->success(__('The widget has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The widget could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('widget'));
        $this->set('_serialize', ['widget']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Widget id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $widget = $this->Widgets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $widget = $this->Widgets->patchEntity($widget, $this->request->data);
            if ($this->Widgets->save($widget)) {
                $this->Flash->success(__('The widget has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The widget could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('widget'));
        $this->set('_serialize', ['widget']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Widget id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $widget = $this->Widgets->get($id);
        if ($this->Widgets->delete($widget)) {
            $this->Flash->success(__('The widget has been deleted.'));
        } else {
            $this->Flash->error(__('The widget could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
