<?php

class ContactController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

 	public function indexAction()
    {
        $form = new Form_Contact();
          if ($this->getRequest()->isPost()) { /* wywołuje się jeśli formularz został wysłany */
               if ($form->isValid($this->getRequest()->getPost())) { /* waliduje formularz */
                    $smtpServer = 'smtp.gmail.com';
                    $username = 'cykcykacz@gmail.com';
                    $password = 'sajmon54';


                    $config = array('ssl' => 'tls',
								   'port' => '587',
                                   'auth' => 'login',
                               'username' => $username,
                               'password' => $password);

                    $transport = new Zend_Mail_Transport_Smtp($smtpServer, $config);
					
                    $wiadomosc = $form->getValue('wiadomosc');

                    $mail = new Zend_Mail('utf-8');
                    $mail->setFrom('cykcykacz@gmail.com', 'Elementywww');
                    $mail->addTo($form->getValue('email'), 'Server');
                    $mail->setSubject($form->getValue('subject'));
                    $mail->setBodyText($form->getValue('wiadomosc'));
                    $mail->send($transport);
                    
                   /* $this->_helper->flashMessenger->addMessage('Dziękujemy za wysłanie formularza');
                    $this->_helper->redirector->gotoRouteAndExit(array(), 'default-contact-index', true);*/
               }
        }
        $this->view->form = $form;
    }


}

