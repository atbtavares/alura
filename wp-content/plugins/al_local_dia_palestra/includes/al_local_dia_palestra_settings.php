<?php

add_action('admin_menu','al_local_dia_palestra_menu');

function al_local_dia_palestra_menu(){
  add_menu_page(
	  'Local Palestra', // page_title
	  'Local Palestra', // menu_title
	  'manage_options',  // cabapitlity
	  'local-palestra', // menu_slug 
	  'al_local_dia_palestra_menu_pagina', // function
	  'dashicons-location-alt', // icon_url
	  -1 // position
  );
}

function al_local_dia_palestra_menu_pagina()
{
	?>
	<div>
		<h1> Local Palestras </h1>
		<form methods="posts" action="options.php ">
			<?php
				do_settings_sections('local-palestra');
			?>
		</form>

	<?php
}

add_action('admin_menu','al_local_dia_palestra_secao');
function al_local_dia_palestra_secao()
{
	add_settings_section(
		'al_local_dia_palestra_secao',
		'Configurações do local da palestra',
		'al_local_dia_palestra_campos_secao_detalhes',
		'local-palestra'
	);

}
