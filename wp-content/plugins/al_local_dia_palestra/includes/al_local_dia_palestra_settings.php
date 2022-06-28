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
	// Seção
	add_settings_section(
		'al_local_dia_palestra_secao',
		'Configurações do local da palestra',
		'al_local_dia_palestra_campos_secao_detalhes',
		'local-palestra'
	);

	// Endereço
	add_settings_field(
		'al_local_dia_palestra_endereco',
		'Endereço',
		'al_local_dia_palestra_endereco',
		'local-palestra',
		'al_local_dia_palestra_secao'
	);

	register_setting(
		'al_local_dia_palestra_settings', // option_group
		'al_local_dia_palestra_endereco'  // option_name
	);
}

function al_local_dia_palestra_campos_secao_detalhes()
{
	?>
	<p>Insira os dados do encereço, da cidade e data da próxima palestra da Alura</p>
	<?php	
}

function al_local_dia_palestra_endereco()
{
	?>
	<input type="text" id="al_local_dia_palestra_endereco"
		name="al_local_dia_palestra_endereco" required>
	<?php
}

