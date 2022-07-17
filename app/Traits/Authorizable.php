<?php

/**
 * Created by VS.
 * User: Araf
 * Date: 03/04/22
 * Time: 5:39 PM
 */

namespace App\Traits;


trait Authorizable
{

    private $abilities = [
        'index' => 'view',
        'edit' => 'edit',
        'show' => 'view',
        'update' => 'edit',
        'create' => 'add',
        'store' => 'add',
        'destroy' => 'delete'
    ];

    /**
     * Override of callAction to perform the authorization before
     *
     * @param $method
     * @param $parameters
     * @return mixed
     */
    public function callAction($method, $parameters)
    {
        if ($ability = $this->getAbility($method)) {
            $this->authorize($ability);
        }

        return parent::callAction($method, $parameters);
    }

    public function getAbility($method)
    {
        $routeName = explode('.', request()->route()->getName());
        $action = array_get($this->getAbilities(), $method);

        $ability = $action ? $action . '_' . $routeName[0] : null;

        return $ability;
    }

    private function getAbilities()
    {
        return $this->abilities;
    }

    public function setAbilities($abilities)
    {
        $this->abilities = $abilities;
    }
}
