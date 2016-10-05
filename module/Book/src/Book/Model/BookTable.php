<?php
/**
 * Created by PhpStorm.
 * User: steinmann
 * Date: 09.09.16
 * Time: 15:55
 */

namespace Book\Model;

use Zend\Db\TableGateway\TableGateway;

class BookTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getBook($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveBook(Book $book)
    {
        $data = array(
            'user_name' => $book->user_name,
            'email'  => $book->email,
            'home_page'  => $book->home_page,
            'message'  => $book->message,
            'message_date'  => $book->message_date,
            'user_ip' => $book->user_ip,
        );

        $id = (int) $book->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getBook($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Message id does not exist');
            }
        }
    }

    public function deleteBook($id)
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
}