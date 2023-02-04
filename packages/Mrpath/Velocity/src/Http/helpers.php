<?php

if (! function_exists('velocity')) {
    /**
     * Velocity helper.
     *
     * @return \Mrpath\Velocity\Velocity
     */
    function velocity()
    {
        return app()->make(\Mrpath\Velocity\Velocity::class);
    }
}
