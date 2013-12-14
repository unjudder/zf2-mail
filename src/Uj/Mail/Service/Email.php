<?php
/**
 * Unjudder Mail Module on top of Zendframework 2
 *
 * @link http://github.com/unjudder/zf2-mail for the canonical source repository
 * @copyright Copyright (c) 2012 unjudder
 * @license http://unjudder.com/license/new-bsd New BSD License
 * @package Uj\Mail
 */
namespace Uj\Mail\Service;

use Zend\Mail\Message;
use Zend\Mail\Transport\TransportInterface;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\RendererInterface;

/**
 * Uj\Mail email service class.
 *
 * @since 1.0
 * @package Uj\Mail\Service
 */
class Email
{
    /**
     * The mail transport
     *
     * @var TransportInterface
     */
    protected $transport = null;

    /**
     * The email renderer.
     *
     * @var RendererInterface
     */
    protected $renderer = null;

    /**
     * Initialize the mail service
     *
     * @param TransportInterface $transport
     */
    public function __construct(TransportInterface $transport, RendererInterface $renderer)
    {
        $this->transport = $transport;
        $this->renderer = $renderer;
    }

    /**
     * Sends an email.
     *
     * @param string|Message $tpl
     * @param array          $data
     */
    public function send($tpl, array $data = null)
    {
        if ($tpl instanceof Message) {
            $mail = $tpl;
        } else {
            if ($data === null) {
                throw new \InvalidArgumentException('Expected data to be array, null given.');
            }

            $mail = $this->getMessage($tpl, $data);
        }

        $this->getTransport()->send($mail);
    }

    /**
     * @param  string  $tpl
     * @param  array   $data
     * @return Message
     */
    public function getMessage($tpl, array $data)
    {
        $mail = new Message();

        if (isset($data['encoding'])) {
            $mail->setEncoding($data['encoding']);
        }
        if (isset($data['from'])) {
            call_user_func_array(array($mail, "setFrom"), (array) $data['from']);
        }
        if (isset($data['to'])) {
            call_user_func_array(array($mail, "setTo"), (array) $data['to']);
        }
        if (isset($data['cc'])) {
            call_user_func_array(array($mail, "setCc"), (array) $data['cc']);
        }
        if (isset($data['bcc'])) {
            call_user_func_array(array($mail, "setBcc"), (array) $data['bcc']);
        }
        if (isset($data['subject'])) {
            $mail->setSubject($data['subject']);
        }
        if (isset($data['sender'])) {
            call_user_func_array(array($mail, "setSender"), (array) $data['sender']);
        }
        if (isset($data['replyTo'])) {
            call_user_func_array(array($mail, "setReplyTo"), (array) $data['replyTo']);
        }

        $content = $this->renderMail($tpl, $data);
        $mail->setBody($content);
        $mail->getHeaders()
            ->addHeaderLine('Content-Type', 'text/plain; charset=UTF-8')
            ->addHeaderLine('Content-Transfer-Encoding', '8bit');

        return $mail;
    }

    /**
     * Returns the mail transport
     *
     * @return \Zend\Mail\Transport\TransportInterface
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * Sets the transport
     *
     * @param TransportInterface $transport
     */
    public function setTransport(TransportInterface $transport)
    {
        $this->transport = $transport;
    }

    /**
     * @return \Zend\View\Renderer\RendererInterface
     */
    public function getRenderer()
    {
        return $this->renderer;
    }

    /**
     * @param \Zend\View\Renderer\RendererInterface $renderer
     */
    public function setRenderer(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * Render a given template with given data assigned.
     *
     * @param  string $tpl
     * @param  array  $data
     * @return string The rendered content.
     */
    protected function renderMail($tpl, array $data)
    {
        $viewModel = new ViewModel($data);
        $viewModel->setTemplate($tpl);

        return $this->renderer->render($viewModel);
    }
}
