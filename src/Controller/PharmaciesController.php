<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Pharmacies Controller
 *
 * @property \App\Model\Table\PharmaciesTable $Pharmacies
 * @method \App\Model\Entity\Pharmacy[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PharmaciesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $pharmacies = $this->paginate($this->Pharmacies);

        $this->set(compact('pharmacies'));
    }

    /**
     * View method
     *
     * @param string|null $id Pharmacy id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pharmacy = $this->Pharmacies->get($id, [
            'contain' => ['Users', 'Comments', 'Products'],
        ]);

        $this->set(compact('pharmacy'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pharmacy = $this->Pharmacies->newEmptyEntity();
        if ($this->request->is('post')) {
            $pharmacy = $this->Pharmacies->patchEntity($pharmacy, $this->request->getData());
            if ($this->Pharmacies->save($pharmacy)) {
                $this->Flash->success(__('The pharmacy has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pharmacy could not be saved. Please, try again.'));
        }
        $users = $this->Pharmacies->Users->find('list', ['limit' => 200]);
        $this->set(compact('pharmacy', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Pharmacy id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pharmacy = $this->Pharmacies->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pharmacy = $this->Pharmacies->patchEntity($pharmacy, $this->request->getData());
            if ($this->Pharmacies->save($pharmacy)) {
                $this->Flash->success(__('The pharmacy has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pharmacy could not be saved. Please, try again.'));
        }
        $users = $this->Pharmacies->Users->find('list', ['limit' => 200]);
        $this->set(compact('pharmacy', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Pharmacy id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pharmacy = $this->Pharmacies->get($id);
        if ($this->Pharmacies->delete($pharmacy)) {
            $this->Flash->success(__('The pharmacy has been deleted.'));
        } else {
            $this->Flash->error(__('The pharmacy could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
