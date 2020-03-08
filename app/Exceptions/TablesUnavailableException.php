<?php declare(strict_types = 1);

namespace App\Exceptions;

use Exception;
use Illuminate\Http\RedirectResponse;

class TablesUnavailableException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return RedirectResponse
     */
    public function render($request): RedirectResponse
    {
        return back()->withInput()->withErrors(['party_size' => $this->getMessage()]);
    }
}
