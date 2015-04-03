<?php

 return [
     // either UsrLastlyStorageEloquent or UsrLastlyStorageRdis are bundled by default
     'storage' => 'UsrLastlyStorageEloquent',

     // This one is bundled, overwrite if you create your own
     'user_provider' => 'UsrLastlyUserLaravel',

     // Which redis connection to use
     'redis' => 'default',
 ];
