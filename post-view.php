<?php
//Add the following code into the place where you want to insert the block:

apply_filters( 'litespeed_esi_url', 'malimobil_esi_block', 'Malimobil ESI block' );

//For example :
?>
<div>
<?php
echo apply_filters( 'litespeed_esi_url', 'malimobil_esi_block', 'Malimobil ESI block' );
?>
  <a href="https://malimobil.com/wordpress-litespeed-esi-exclude-view-count-block-cache/">Example</a>
</div>
<?php
//and then add following code into your theme’s functions.php:

add_action( 'litespeed_esi_load-malimobil_esi_block', 'malimobil_esi_block_esi_load' );

function malimobil_esi_block_esi_load()
{
do_action( 'litespeed_control_set_ttl', 300 ); // time to live 300
#do_action( 'litespeed_control_set_nocache' ); // no cache
echo "Hello world".rand (1,99999);
}
//In this example, malimobil_esi_block is the block name, Malimobil ESI block is a short comment, and 300 is the TTL for this block.

//You can change it to do_action( 'litespeed_control_set_nocache' ); if you want to set this block to no-cache.
