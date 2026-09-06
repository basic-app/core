<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\Core;

use CodeIgniter\RESTful\ResourceController as BaseResourceController;
use BasicApp\Core\Traits\Resource;
use BasicApp\Core\Traits\Messages;

abstract class ResourceController extends BaseResourceController
{
    use Resource, Messages;
    /**
     * Constructor.
     *
     * @return void
     */
    public function initController(
        RequestInterface $request, 
        ResponseInterface $response, 
        LoggerInterface $logger)
    {
        // Load here all helpers you want to be available in your controllers that extend BaseController.
        // Caution: Do not put the this below the parent::initController() call below.
        // $this->helpers = ['form', 'url'];

        // Caution: Do not edit this line.
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        $this->session = service('session');
    
        $this->initialize();
    }

    protected function initialize()
    {
    }
}