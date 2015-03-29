<?php

 return [
     // either eloquent or redis
     'storage' => 'eloquent',

     // This one is bundled, overwrite if you create your own
     'user_provider' => 'UsrLastlyUserLaravel',

     // Which redis connection to use
     'redis' => 'default',
 ];