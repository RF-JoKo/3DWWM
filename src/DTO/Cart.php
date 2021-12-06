<?php

declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Cart
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function get()
    {
        return $this->session->get('cart');
    }
}
