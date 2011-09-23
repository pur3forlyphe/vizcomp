<?php
class DocumentsController extends AppController {

	var $name = 'Documents';

	function index(){
		$this->Document->recursive = 0;
		$this->set('documents', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid document', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('document', $this->Document->read(null, $id));
	}
	
	function play($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid document', true));
			$this->redirect(array('action' => 'index'));
		}
		
		$document = $this->Document->read(null, $id);
		$video = $document['Document'];

		$pathPieces = explode('/', $video['original']);
          $videoLink = array_pop($pathPieces);
          $directory = array_pop($pathPieces);
		
		if ($video['file_type'] == 'video/mp4'){

			$this->layout = 'video_player';
			$this->set('video', $video);
			
		}
	}

	function add() {
		if (!empty($this->data)) {
			if($this->data[$this->Document->alias]['file']['error'] == 0 && is_uploaded_file($this->data[$this->Document->alias]['file']['tmp_name']))
			{
				$file = $this->data[$this->Document->alias]['file'];
				$uniqueFile = tempnam(Configure::read('Asset.dir').DS.'documents'.DS, md5(microtime()));
				$filename = end(explode(DS,$uniqueFile));
				unlink($uniqueFile);
				$ext = explode('.', $file['name']);
				if(count($ext) > 1)
				{
					$ext = end($ext);
				}
				else
				{
					$ext = '';
				}
				if ($this->data[$this->Document->alias]['file']["type"] == 'video/mp4' ){
					move_uploaded_file($file['tmp_name'], APP. DS . WEBROOT_DIR . DS . 'videos' . DS .$filename .'.mp4');
					
					
					$this->data[$this->Document->alias]['original'] = ('videos'. DS .$filename);
					$this->data[$this->Document->alias]['extension'] = $ext;
					$this->data[$this->Document->alias]['file_name'] = $file['name'];
					$this->data[$this->Document->alias]['file_type'] = $this->data[$this->Document->alias]['file']["type"];
					unset($this->data[$this->Document->alias]['file']);
					//Set owner id to be that of the logged in person
					$this->data['Document']['user_id'] = $this->Auth->user('id');
					$this->data['Document']['client_id'] = $this->Auth->user('client_id');
					$this->Document->create();
					if($this->Document->saveAll($this->data, array('validate' => 'first')))
					{
						$this->Session->setFlash(__('Document successfully uploaded', true));
						$this->redirect(array('controller' => 'documents', 'action' => 'index'));
					} else {
						debug($this->Document->validationErrors);
				}
				}
				move_uploaded_file($file['tmp_name'],strtolower(Configure::read('Asset.dir').DS.'documents'.DS.$filename));
				$this->data[$this->Document->alias]['original'] = strtolower(DS.'documents'.DS.$filename);
				$this->data[$this->Document->alias]['extension'] = $ext;
				$this->data[$this->Document->alias]['file_name'] = $file['name'];
				$this->data[$this->Document->alias]['file_type'] = $this->data[$this->Document->alias]['file']["type"];
				unset($this->data[$this->Document->alias]['file']);
				//Set owner id to be that of the logged in person
				$this->data['Document']['user_id'] = $this->Auth->user('id');
				$this->data['Document']['client_id'] = $this->Auth->user('client_id');
				if($this->Document->saveAll($this->data, array('validate' => 'first')))
				{
					$this->Session->setFlash(__('Document successfully uploaded', true));
					$this->redirect(array('controller' => 'documents', 'action' => 'index'));
				} else {
					debug($this->Document->validationErrors);
				}
			}
		}
	} 
	
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid document', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Document->save($this->data)) {
				$this->Session->setFlash(__('The document has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The document could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Document->read(null, $id);
		}
		$clients = $this->Document->Client->find('list');
		$users = $this->Document->User->find('list');
		$this->set(compact('clients', 'users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for document', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Document->delete($id)) {
			$this->Session->setFlash(__('Document deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Document was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	public function download($id = null)
    {
      $this->view = 'Media';
      if($id)
      {
       $modelAlias = $this->Document->alias;
        //Get the asset by id
        $document = $this->Document->find(
          'first',
          array(
            'conditions' => array(
              $modelAlias.'.id' => $id
            ),
            'contain' => array()
          )
        );
        if($document)
        {
          $pathPieces = explode('/', $document[$modelAlias]['original']);
          $id = array_pop($pathPieces);
          $directory = array_pop($pathPieces);
          //We may have more directories left to 'pop'
          $anotherDirectory = array_pop($pathPieces);
          while($anotherDirectory != null)
          {
            $directory = $anotherDirectory . '/' . $directory;
            $anotherDirectory = array_pop($pathPieces);
          }
          $fileName = $document[$modelAlias]['file_name'];
          $params = array(
            'id' => $id,
            'name' => $fileName,
            'download' => true,
            'extension' => $document[$modelAlias]['extension'],
            'mimeType' => array( $document[$modelAlias]['extension'] =>  $document[$modelAlias]['file_type']),
            'path' => ROOT.DS.'assets'.DS.$directory.DS
          );
          $this->set($params);
        }
      }
    }
}
