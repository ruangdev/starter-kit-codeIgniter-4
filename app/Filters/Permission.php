<?php

namespace App\Filters;

use Myth\Auth\Filters\BaseFilter;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Myth\Auth\Exceptions\PermissionException;

class Permission extends BaseFilter implements FilterInterface
{
    /**
     * @param array|null $arguments
     *
     * @return RedirectResponse|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        if (! $this->authenticate->check()) {
            session()->set('redirect_url', current_url());
                return redirect($this->reservedRoutes['login']);
        }

        if (empty($arguments)) {
            return;
        }

        $result = true;

        foreach ($arguments as $permission) {
            $result = ($result && $this->authorize->hasPermission($permission, $this->authenticate->id()));
        }

        if (! $result) {
            if ($this->authenticate->silent()) {
                $redirectURL = session('redirect_url') ?? route_to($this->landingRoute);
                unset($_SESSION['redirect_url']);
                    return redirect()->to($redirectURL)->with('error', lang('Auth.notEnoughPrivilege'));
            }
                return redirect()->to(route_to('page.403'));
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param array|null $arguments
     *
     * @return void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}
