<?php
    if (! function_exists('bouncer')) {
        function bouncer()
        {
            return app()->make(\Mrpath\User\Bouncer::class);
        }
    }
?>