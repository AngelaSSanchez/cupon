<?php

namespace AppBundle\Listener;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Routing\Router;

/**
 * Listener del evento SecurityInteractive que se utiliza para redireccionar
 * al usuario recién logueado a la portada de su ciudad.
 */
class LoginListener
{
    /** @var AuthorizationChecker */
    private $checker;
    private $router, $ciudad = null;

    public function __construct(AuthorizationChecker $checker, Router $router)
    {
        $this->checker = $checker;
        $this->router = $router;
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $token = $event->getAuthenticationToken();
        $this->ciudad = $token->getUser()->getCiudad()->getSlug();
        
    }

   public function onKernelResponse(FilterResponseEvent $event)
 {
        if (null === $this->ciudad) {
            return;
        }

        $urlPortada = $this->router->generate('portada', array( 'ciudad' => $this->ciudad));

                
        $event->setResponse(new RedirectResponse($urlPortada));
    }

}
