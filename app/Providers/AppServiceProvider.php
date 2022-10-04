<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //for pagination
        Paginator::useBootstrapFive();

        //the section to be rendered is only for specific roles pass argument as string
        Blade::directive('role', function ($expression) {
            return "<?php

                    \$has_specified_role = false;
                    foreach(Auth::user()->roles as \$role){
                        if (strtolower(\$role->role_name) == strtolower($expression)){
                            \$has_specified_role = true;
                            break;
                        }
                    }

                    if(\$has_specified_role){?>";
        });

        Blade::directive('endrole', function () {
            return "<?php } ?>";
        });

        //use this if you require them to have multiple roles (all of them) pass argument as array
        Blade::directive('hasRoles', function ($expression) {
            return "<?php
                    \$count = 0;
                    foreach($expression as \$rolecheck){
                        foreach(Auth::user()->roles as \$userrole){
                            if(strtolower(\$rolecheck) == strtolower(\$userrole->role_name)){
                                \$count++;
                            }
                        }
                    }

                    if(\$count == count($expression)){ ?>";
        });

        Blade::directive('endHasRoles', function () {
            return "<?php } ?>";
        });

        //this is for has any roles, usage is @HasAnyRole(['roles']) in form of array
        Blade::directive('HasAnyRole', function ($expression) {
            return "<?php
                    \$has_any_of_role = false;
                    foreach($expression as \$rolecheck){
                        foreach(Auth::user()->roles as \$userrole){
                            if(strtolower(\$rolecheck) == strtolower(\$userrole->role_name)){
                                \$has_any_of_role = true;
                                break;
                            }
                        }
                    }

                    if(\$has_any_of_role){ ?>";
        });

        Blade::directive('EndHasAnyRoles', function () {
            return "<?php } ?>";
        });
    }
}
