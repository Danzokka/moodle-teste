<option value="">Escolha</option>
<?php
if($_POST['estado']=="Acre" or $_POST['estado']=="ACRE"){                         $_POST['estado'] = "AC"; }
if($_POST['estado']=="Alagoas" or $_POST['estado']=="ALAGOAS"){                   $_POST['estado'] = "AL"; }
if($_POST['estado']=="Amapá" or $_POST['estado']=="AMAPÁ"){                       $_POST['estado'] = "AP"; }
if($_POST['estado']=="Amazonas" or $_POST['estado']=="AMAZONAS"){                 $_POST['estado'] = "AM"; }
if($_POST['estado']=="Bahia" or $_POST['estado']=="BAHIA"){                       $_POST['estado'] = "BA"; }
if($_POST['estado']=="Ceará" or $_POST['estado']=="CEARÁ"){                       $_POST['estado'] = "CE"; }
if($_POST['estado']=="Distrito Federal" or $_POST['estado']=="DISTRITO FEDERAL"){ $_POST['estado'] = "DF"; }
if($_POST['estado']=="Espírito Santo" or $_POST['estado']=="ESPÍRITO SANTO"){     $_POST['estado'] = "ES"; }
if($_POST['estado']=="Goiás" or $_POST['estado']=="GOIÁS"){                       $_POST['estado'] = "GO"; }
if($_POST['estado']=="Maranhão" or $_POST['estado']=="MARANHÃO"){                 $_POST['estado'] = "MA"; }
if($_POST['estado']=="Mato Grosso" or $_POST['estado']=="MATO GROSSO"){           $_POST['estado'] = "MT"; }
if($_POST['estado']=="Mato Grosso do Sul" or $_POST['estado']=="MATO GROSSO DO SUL"){  $_POST['estado'] = "MS"; }
if($_POST['estado']=="Minas Gerais" or $_POST['estado']=="MINAS GERAIS"){         $_POST['estado'] = "MG"; }
if($_POST['estado']=="Pará" or $_POST['estado']=="PARÁ"){                         $_POST['estado'] = "PA"; }
if($_POST['estado']=="Paraíba" or $_POST['estado']=="PARAÍBA"){                   $_POST['estado'] = "PB"; }
if($_POST['estado']=="Paraná" or $_POST['estado']=="PARANÁ"){                     $_POST['estado'] = "PR"; }
if($_POST['estado']=="Pernambuco" or $_POST['estado']=="PERNAMBUCO"){             $_POST['estado'] = "PE"; }
if($_POST['estado']=="Piauí" or $_POST['estado']=="PIAUÍ"){                       $_POST['estado'] = "PI"; }
if($_POST['estado']=="Rio de Janeiro" or $_POST['estado']=="RIO DE JANEIRO"){     $_POST['estado'] = "RJ"; }
if($_POST['estado']=="Rio Grande do Norte" or $_POST['estado']=="RIO GRANDE DO NORTE"){ $_POST['estado'] = "RN"; }
if($_POST['estado']=="Rio Grande do Sul" or $_POST['estado']=="RIO GRANDE DO SUL"){     $_POST['estado'] = "RS"; }
if($_POST['estado']=="Rondônia" or $_POST['estado']=="RONDÔNIA"){                 $_POST['estado'] = "RO"; }
if($_POST['estado']=="Roraima" or $_POST['estado']=="RORAIMA"){                   $_POST['estado'] = "RR"; }
if($_POST['estado']=="Santa Catarina" or $_POST['estado']=="SANTA CATARINA"){     $_POST['estado'] = "SC"; }
if($_POST['estado']=="São Paulo" or $_POST['estado']=="SÃO PAULO"){               $_POST['estado'] = "SP"; }
if($_POST['estado']=="Sergipe" or $_POST['estado']=="SERGIPE"){                   $_POST['estado'] = "SE"; }
if($_POST['estado']=="Tocantins" or $_POST['estado']=="TOCANTINS"){               $_POST['estado'] = "TO"; }

if($_POST['estado']){
	//$json = file_get_contents("https://servicodados.ibge.gov.br/api/v1/localidades/estados/".$_POST['estado']."/municipios");
	$json = file_get_contents("municipios/municipios-".strtolower($_POST['estado']).".json");
	$data = json_decode($json);

	foreach ($data as $key => $value) {
		//echo $value->nome;
		?>
		<option value="<?php echo str_replace("'","",$value->nome) ?>"<?php if(str_replace("'","",$_POST['municipio'])==str_replace("'","",$value->nome)){ ?> selected<?php } ?>><?php echo str_replace("'","",$value->nome) ?></option>
		<?php
	}
}
?>