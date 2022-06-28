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
				settings_fields('al_local_dia_palestra_settings');
				submit_button();
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
		'al_local_dia_palestra_endereco',  // option_name
		'verifica_endereco' // args:
	);

	
	// Cidade
	add_settings_field(
		'al_local_dia_palestra_cidade',
		'Cidade',
		'al_local_dia_palestra_cidade',
		'local-palestra',
		'al_local_dia_palestra_secao'
	);

	register_setting(
		'al_local_dia_palestra_settings', // option_group
		'al_local_dia_palestra_cidade',  // option_name
		'verifica_cidade' // args:
	);

	// Data
	add_settings_field(
		'al_local_dia_palestra_data',
		'Data',
		'al_local_dia_palestra_data',
		'local-palestra',
		'al_local_dia_palestra_secao'
	);

	register_setting(
		'al_local_dia_palestra_settings', // option_group
		'al_local_dia_palestra_data',  // option_name
		'verifica_data' // args:
	);

	

}

function al_local_dia_palestra_campos_secao_detalhes()
{
	?>
	<p>Insira os dados do encereço, da cidade e data da próxima palestra da Alura</p>
	<?php	
}

// Função callback endereço
function al_local_dia_palestra_endereco()
{
	?>
	<input type="text" id="al_local_dia_palestra_endereco"
		name="al_local_dia_palestra_endereco" value="<?= esc_attr(get_option("al_local_dia_palestra_endereco")) ?>" required>
	<?php
}

// Função callback cidade
function al_local_dia_palestra_cidade()
{
	?>
	<input type="text" id="al_local_dia_palestra_cidade"
		name="al_local_dia_palestra_cidade" value="<?= esc_attr(get_option("al_local_dia_palestra_cidade")) ?>" required>
	<?php
}


// Função callback data
function al_local_dia_palestra_data()
{
	?>
	<input type="date" id="al_local_dia_palestra_data"
		name="al_local_dia_palestra_data" value="<?= esc_attr(get_option("al_local_dia_palestra_data")) ?>" required>
	<?php
}

/*
 * Configuraço de callback de verificação dos campos
 */

 // Endereço
 function verifica_endereco($endereco){
	if(empty($endereco)){
		$endereco = get_option('al_local_dia_palestra_endereco');
		add_settings_error(
			'al_local_dia_palestra_mensagem_erro', // setting:
			'al_local_dia_palestra_erro_endereco', // code:
			'O campo endereço deve ser preenchido', // message:
			'error' // type:
		);
	}
	return $endereco;
 }

 
 // Cidade
 function verifica_cidade($cidade){
	if(empty($cidade)){
		$cidade = get_option('al_local_dia_palestra_cidade');
		add_settings_error(
			'al_local_dia_palestra_mensagem_erro', // setting:
			'al_local_dia_palestra_erro_cidade', // code:
			'O campo cidade deve ser preenchido', // message:
			'error' // type:
		);
	}
	return $cidade;
 }

 
 // Data
 function verifica_data($data){
	if(empty($data)){
		$data = get_option('al_local_dia_palestra_data');
		add_settings_error(
			'al_local_dia_palestra_mensagem_erro', // setting:
			'al_local_dia_palestra_erro_data', // code:
			'O campo data deve ser preenchido', // message:
			'error' // type:
		);
	}
	return $data;
 }