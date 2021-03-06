<?php

/**
 * TechDivision\WebSocketContainer\RatchetReceiver
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 */
namespace TechDivision\WebSocketContainer;

use TechDivision\ApplicationServer\AbstractReceiver;
use Ratchet\Server\IoServer;

/**
 *
 * @package TechDivision\WebSocketContainer
 * @copyright Copyright (c) 2010 <info@techdivision.com> - TechDivision GmbH
 * @license http://opensource.org/licenses/osl-3.0.php
 *          Open Software License (OSL 3.0)
 * @author Tim Wagner <tw@techdivision.com>
 */
class RatchetReceiver extends AbstractReceiver
{

    /**
     * Returns the resource class used to create a new socket.
     *
     * @return string The resource class name
     */
    protected function getResourceClass()
    {
        return '';
    }

    /**
     * (non-PHPdoc)
     *
     * @see \TechDivision\ApplicationServer\AbstractReceiver::start()
     */
    public function start()
    {

        // create a custom ratchet request instance
        $requestInstance = $this->newInstance($this->getThreadType(), array(
            $this->getContainer()
                ->getApplications()
        ));

        // initialize and start the ratchet worker instance
        $workerInstance = $this->newInstance($this->getWorkerType(), array(
            $requestInstance,
            $this->getPort(),
            $this->getAddress()
        ));
        $workerInstance->run();
    }
}