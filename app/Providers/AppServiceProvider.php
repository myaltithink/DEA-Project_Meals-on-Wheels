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
        /**
         *
         * Usage: @role('ROLE_PARTNER')
         *             <to render here>
         *        @endrole
         */
        Blade::directive('role', function ($expression) {
            return "<?php
                        if(Auth::user()->hasPermission($expression)){
                    ?>";
        });

        Blade::directive('endrole', function () {
            return "<?php } ?>";
        });

        //use this if you require them to have multiple roles (all of them) pass argument as array
        /**
         * Usage: @hasRoles(['ROLE_ADMIN', 'ROLE_MEMBER'])
         *          <to render here>
         *        @endHasRoles
         */
        Blade::directive('hasRoles', function ($expression) {
            return "<?php
                        if(Auth::user()->hasRoles($expression)){
                    ?>";
        });

        Blade::directive('endHasRoles', function () {
            return "<?php } ?>";
        });

        //this is for has any roles, usage is @HasAnyRole(['roles']) in form of array
        /**
         * Usage: @hasAnyRole(['ROLE_ADMIN', 'ROLE_MEMBER'])
         *          <to render here>
         *        @EndHasAnyRoles
         */
        Blade::directive('HasAnyRole', function ($expression) {
            return "<?php
                        if(Auth::user()->hasAnyRole($expression)){
                    ?>";
        });

        Blade::directive('EndHasAnyRoles', function () {
            return "<?php } ?>";
        });

        //render but excluding particular roles, better to use array of roles than string but string can also be used if only one role.
        /**
         * Usage: @ExcludeRole('ROLE_MEMBER')
         *          <to render here>
         *        @EndExcludeRole
         */
        Blade::directive('ExcludeRole', function($expression){
            return
                "
                <?php
                    if(!Auth::user()->hasAnyRole($expression)){
                ?>";
        });

        Blade::directive('EndExcludeRole', function(){
            return "<?php } ?>";
        });

    }
}
