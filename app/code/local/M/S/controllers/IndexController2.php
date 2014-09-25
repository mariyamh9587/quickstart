<?php

class M_S_IndexController extends Mage_Core_Controller_Front_Action
{

    public function indexAction()
    {
        $this->check_login();
        $this->loadLayout();
        $this->renderLayout();
    }

    public function formAction()
    {
        $this->check_login();
        $this->loadLayout();
        $this->renderLayout();
    }

    public function postAction()
    {

        $this->check_login();

        $id = (int) $this->getRequest()->getParam('id');
        $updated = $id;
        //var_dump($id);
        //$model = Mage::getSingleton('s/s')->getConnection('core_write');
//        $model = Mage::getModel('s/s')->load($id);
//        $data = $model->getData();
//        $model->setData($data)->setId($id);
//        $collection = Mage::getModel('s/s')->getCollection()->getItems();
//        // var_dump($collection);exit;
        $params = $this->getRequest()->getParams();
        // var_dump($params);exit;
        $model = Mage::getModel('s/s');
        if ($id)
        {
            $model->load($id);
        }

//var_dump(Mage::getModel('s/s')->load($id)->getData());
        //$model->setUrl('10');
        $model->title = Mage::getSingleton('customer/session')->getCustomer()->getFirstname() . ' ' . Mage::getSingleton('customer/session')->getCustomer()->getLastname();
        //$model->filename = Mage::getSingleton('customer/session')->getCustomerId() . 'test';
        $model->created_time = date('Y-m-d H:i:s');
        $model->content = htmlspecialchars($params['content'], ENT_QUOTES);
        $model->url = $params['url'];
        if(!empty($params['date']))
        {
            $model->date = date('Y-m-d', strtotime($params['date']));
        }
        $model->price = $params['price'];
        if ($id)
        {
            $model->s_id = $id;
        }

        //var_dump($model->content);exit;
        $model->save();
        
        //var_dump($model);exit;
        if($updated)
            $message = 'Your Order Updated, Thank you.';
        else
            $message = 'Your Order Placed, Thank you.';
        Mage::getSingleton('core/session')->addSuccess($message);
        //$url = Mage::getUrl('s/index/update', array('id'=>$model->s_id,'msg'=>1));
        $url = Mage::getUrl('s/index/update', array('id'=>$model->s_id));
        Mage::app()->getFrontController()->getResponse()->setRedirect($url);
    }

    public function updateAction()
    {


        //var_dump($model->getData());exit;
        //$model->beginTransaction();
        /* $params = $this->getRequest()->getParams();
          //$fields = array();
          $model->content = $params['content'];
          $model->url = $params['url'];
          $model->date = date('Y-m-d', strtotime($params['date']));
          $model->price = $params['price'];
          //$fields['name'] = 'jony';
          // $where = $model->quoteInto('id =?', '1');
          var_dump($model);exit;
          $model->update('s', $model, $where);
          $message = 'Your Order Update, Thank you.';
          Mage::getSingleton('core/session')->addSuccess($message);
          $url = Mage::getBaseUrl() . 's';
          Mage::app()->getFrontController()->getResponse()->setRedirect($url);
          $model->commit(); */
        $this->loadLayout();
        $this->renderLayout();
    }

    public function deleteAction()
    {
         $id = (int) $this->getRequest()->getParam('id');
        $model = Mage::getModel('s/s');
         try
        {
           $model->setId($id)->delete(); 
           //$message = 'Data deleted successfully.';
          //Mage::getSingleton('core/session')->addSuccess($message);
     
            //$url = Mage::getBaseUrl() . 'special-order';
            // Mage::app()->getFrontController()->getResponse()->setRedirect($url);
           $res = 1;
        }
        catch (Exception $e)
        {
            $res = 0;
            echo $e->getMessage();
        }
         echo $res;
    }

    private function check_login()
    {
        if (!Mage::getSingleton('customer/session')->isLoggedIn())
        {
            Mage::getSingleton('customer/session')->setData('redirect_sp_order', 1);
            Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getUrl('customer/account'));
        }
    }

}