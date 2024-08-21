<?php

namespace Controller;

use Class\Renderer;

class PaymentController
{
    public function showSuccess(): Renderer
    {

        return Renderer::make('success', []);
    }

    public function showCancel(): Renderer
    {

        return Renderer::make('cancel', []);
    }
}