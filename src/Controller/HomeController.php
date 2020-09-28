<?php


declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Client;


/**
 * Home Controller
 *
 * @method \App\Model\Entity\Home[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HomeController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $http = new Client();

        $response = $http->get('http://localhost:8000/api/v1/menu');

        $json = $response->getJson();


        $this->set(['menu_response' => $json]);
        $this->viewBuilder()->setOption('serialize', true);
        $this->RequestHandler->renderAs($this, 'json');    
    }

    public function highlight()
    {
        $http = new Client();

        $response = $http->get('http://localhost:8000/api/v1/highlight');

        $json = $response->getJson();


        $this->set(['highlight_response' => $json]);
        $this->viewBuilder()->setOption('serialize', true);
        $this->RequestHandler->renderAs($this, 'json');    
    }

    public function pojaknas()
    {
        $http = new Client();

        $response = $http->get('http://localhost:8000/api/v1/pojaknas');

        $json = $response->getJson();


        $this->set(['pojaknas_response' => $json]);
        $this->viewBuilder()->setOption('serialize', true);
        $this->RequestHandler->renderAs($this, 'json');    
    }

    public function layanan()
    {
        $http = new Client();

        $response = $http->get('http://localhost:8000/api/v1/layanan');

        $json = $response->getJson();

        $this->set(['layanan_response' => $json]);
        $this->viewBuilder()->setOption('serialize', true);
        $this->RequestHandler->renderAs($this, 'json');    
    }

    public function galeri()
    {
        $http = new Client();

        $response = $http->get('http://localhost:8000/api/v1/galeri');

        $json = $response->getJson();

        $this->set(['galeri_response' => $json]);
        $this->viewBuilder()->setOption('serialize', true);
        $this->RequestHandler->renderAs($this, 'json');    
    }

    public function event()
    {
        $http = new Client();

        $response = $http->get('http://localhost:8000/api/v1/event');

        $json = $response->getJson();

        $this->set(['event_response' => $json]);
        $this->viewBuilder()->setOption('serialize', true);
        $this->RequestHandler->renderAs($this, 'json');    
    }

    /**
     * View method
     *
     * @param string|null $id Home id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $home = $this->Home->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('home'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $home = $this->Home->newEmptyEntity();
        if ($this->request->is('post')) {
            $home = $this->Home->patchEntity($home, $this->request->getData());
            if ($this->Home->save($home)) {
                $this->Flash->success(__('The home has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The home could not be saved. Please, try again.'));
        }
        $this->set(compact('home'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Home id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $home = $this->Home->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $home = $this->Home->patchEntity($home, $this->request->getData());
            if ($this->Home->save($home)) {
                $this->Flash->success(__('The home has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The home could not be saved. Please, try again.'));
        }
        $this->set(compact('home'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Home id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $home = $this->Home->get($id);
        if ($this->Home->delete($home)) {
            $this->Flash->success(__('The home has been deleted.'));
        } else {
            $this->Flash->error(__('The home could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
