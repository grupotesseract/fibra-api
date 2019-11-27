<?php

namespace App\ViewComposers;

use Illuminate\View\View;

class RoleComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('roles', \App\Models\Role::getArrayParaSelect());
    }
}
