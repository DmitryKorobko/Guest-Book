<?php
/**
 * Created by PhpStorm.
 * User: steinmann
 * Date: 09.09.16
 * Time: 14:01
 */

namespace Book\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Book\Model\Book;          
use Book\Form\BookForm;
use Zend\View\Model\JsonModel;

class BookController extends AbstractActionController
{
    protected $bookTable;

    public function indexAction()
    {
        $request = $this->getRequest();
        if ($request->isXmlHttpRequest()){
            return "loop";
        }else {
            $form = new BookForm();
            return new ViewModel(array(
                'books' => $this->getBookTable()->fetchAll(),
                'form' => $form,
            ));
        }
    }

//    public function editAction()
//    {
//    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('book');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getBookTable()->deleteBook($id);
            }

            // Redirect to list of books
            return $this->redirect()->toRoute('book');
        }

        return array(
            'id'    => $id,
            'book' => $this->getBookTable()->getBook($id)
        );
    }

    public function getBookTable()
    {
        if (!$this->bookTable) {
            $sm = $this->getServiceLocator();
            $this->bookTable = $sm->get('Book\Model\BookTable');
        }
        return $this->bookTable;
    }

    public function ajaxAction(){
        $form = new BookForm();
        $request = $this->getRequest();
        if ($request->isXmlHttpRequest()){
            $book = new Book();
            $form->setInputFilter($book->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $book->exchangeArray($form->getData());
                $this->getBookTable()->saveBook($book);
                $this->response->setStatusCode(200);
                return new JsonModel(array("message" => "Form is valid!"));
            }else{
                $invalfields = $form->getInputFilter()->getMessages();
                $this->response->setStatusCode(400);
                return new JsonModel($invalfields); //Error message
            }
        }else{
            return false;
        }
    }
}