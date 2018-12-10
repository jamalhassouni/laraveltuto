<?php
Blade::directive('test',function ($val1){
   return 'Test Text '.$val1;
});