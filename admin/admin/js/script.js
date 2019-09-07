"use strict";
var vswpsArrayStart = [];
vswpsArrayStart['vswpsDataPercentage'] = [];
vswpsArrayStart['vswpsDataColor'] = [];
vswpsArrayStart['vswpsDataColorText'] = [];
vswpsArrayStart['vswpsDataText'] = [];
vswpsArrayStart['vswpsDataPercentage'][0] = '';
vswpsArrayStart['vswpsDataColor'][0] = '';
vswpsArrayStart['vswpsDataColorText'][0] = ''; 
vswpsArrayStart['vswpsDataText'][0] = '';
var vswpsCount = 0;
var vswpsCountNew;
var vswpTotalBars;
var vswpsArrayPercentage = [];
var vswpsArrayColorText = [];
var vswpsArrayColor = [];
var vswpsArrayText = [];
var vswpsDataSavePercentage = [];
var vswpsDataSaveColor = [];
var vswpsDataSaveColorText = [];
var vswpsDataSaveText = [];
var vswpsArraySaved;
var vswpsSavedTitle;
var vswpsSavedHeight;
var vswpsSavedPercentage;
var vswpsSavedColor;
var vswpsSavedcolorText;
var vswpsSavedText;
var vswpsHeightBars;
var vswpsTitle;
var vswpsTitleAndHeight = [];
var vswpsNBars;
var vswpdIdEdit;
(function($) {
	jQuery(document).ready(function() {
		vswpsStart();
		vswpsPostValues();
		//reiniciar formulario
		function vswpsReboot(id, vswpsCountTotal) {
			vswpsDeleteBars();
			vswpsDeleteValues();
			vswpsCountNew = 1;
			for(vswpsCount = 0; vswpsCount < vswpsCountTotal; vswpsCount++) {
				if(id['vswpsDataText'][vswpsCount] == undefined) {
					id['vswpsDataText'][vswpsCount] = '';
				}
				jQuery('#vswps-add-percentage').append('<p>' + vswpsCountNew + ' <input class="vswps-add-percentage-new" type="number" style="width: 55px;" min="10" max="100" value="' + id.vswpsDataPercentage[vswpsCount] + '" required />%</p>');
				jQuery('#vswps-add-color').append('<p>' + vswpsCountNew + ' <input class="vswps-add-color-bar-new" type="color" value="' + id['vswpsDataColor'][vswpsCount] + '" required /></p>');
				jQuery('#vswps-add-color-text').append('<p>' + vswpsCountNew + ' <input class="vswps-add-color-bar-text-new" type="color" value="' + id['vswpsDataColorText'][vswpsCount] + '" required /></p>');
				jQuery('#vswps-add-text').append('<p>' + vswpsCountNew + ' <input class="vswps-add-text-bar-new" type="text" value="' + id['vswpsDataText'][vswpsCount] + '" required /></p>');
				vswpsCountNew++;
			}
		}
		//iniciar formulario
		function vswpsStart() {
			vswpsReboot(vswpsArrayStart, 1);	
		}
		//si cambia cantidad de barras
		jQuery('#vswps-n-bars').change(function () {
			vswpTotalBars = jQuery(this).val();
			vswpsReboot(vswpsArrayStart, vswpTotalBars);
			vswpsPostValues();
		});
		//borrar barra color y texto
		function vswpsDeleteBars() {
			jQuery('#vswps-add-percentage').html('');
			jQuery('#vswps-add-color').html('');
			jQuery('#vswps-add-color-text').html('');
			jQuery('#vswps-add-text').html('');
		}
		//borrar post
		function vswpsDeleteValues() {
			vswpsArrayPercentage = [];
			vswpsArrayColorText = [];
			vswpsArrayColor = [];
			vswpsArrayText = [];
			jQuery('#vswps-data-save-percentage').val('');
			jQuery('#vswps-data-save-color').val('');
			jQuery('#vswps-data-save-color-text').val('');
			jQuery('#vswps-data-save-text').val('');
		}
		//carga variables post
		function vswpsPostValues() {
			jQuery('.vswps-add-percentage-new').each(function () {
				vswpsArrayPercentage.push(jQuery(this).val());
			});
			jQuery('#vswps-data-save-percentage').val(vswpsArrayPercentage);
			
			jQuery('.vswps-add-color-bar-new').each(function () {
				vswpsArrayColor.push(jQuery(this).val());
			});
			jQuery('#vswps-data-save-color').val(vswpsArrayColor);
			
			jQuery('.vswps-add-color-bar-text-new').each(function () {
				vswpsArrayColorText.push(jQuery(this).val());
			});
			jQuery('#vswps-data-save-color-text').val(vswpsArrayColorText);
			
			jQuery('.vswps-add-text-bar-new').each(function () {
				vswpsArrayText.push(jQuery(this).val());
			});
			jQuery('#vswps-data-save-text').val(vswpsArrayText);			
		}
		//vista previa
		jQuery('#vswps-link-data-statistics').click(function () {
			console.log('dentro');
			jQuery('#vswps-paint').html('');
			vswpsDeleteValues();
			vswpsPostValues();
			vswpsPreView(1);
		});
		//edit
		jQuery('.vswps-view-input').click(function () {
			vswpdIdEdit = jQuery(this).attr('vswpsId');
			console.log(vswpdIdEdit);
			jQuery('#vswps-id-statistics-edit').val(vswpdIdEdit);
		});
		//html
		function vswpsPreView(id) {
			if(id == 1) {
				vswpsHeightBars = jQuery('#vswps-height-bars').val();
				vswpsTitle = jQuery('#vswps-title').val();
				vswpsNBars = jQuery('#vswps-n-bars').val();
			} else {
				vswpsHeightBars = id[1];
				vswpsTitle = id[0];
				vswpsNBars = id[2];
			}
			vswpsDataSavePercentage = jQuery('#vswps-data-save-percentage').val().split(',');
			vswpsDataSaveColor = jQuery('#vswps-data-save-color').val().split(',');
			vswpsDataSaveColorText = jQuery('#vswps-data-save-color-text').val().split(',');
			vswpsDataSaveText = jQuery('#vswps-data-save-text').val().split(',');
			jQuery('#vswps-paint').append('<h2>' + vswpsTitle + '</h2>');
			jQuery('#vswps-title').val(vswpsTitle);
			jQuery('#vswps-height-bars').val(vswpsHeightBars);
			jQuery('#vswps-n-bars').val(vswpsDataSavePercentage.length);
			vswpsArrayStart['vswpsDataPercentage'] = vswpsDataSavePercentage;
			vswpsArrayStart['vswpsDataColor'] = vswpsDataSaveColor;
			vswpsArrayStart['vswpsDataColorText'] = vswpsDataSaveColorText;
			vswpsArrayStart['vswpsDataText'] = vswpsDataSaveText;
			vswpsReboot(vswpsArrayStart, vswpsDataSavePercentage.length);
			vswpsPostValues();
			for(vswpsCount = 0; vswpsCount < vswpsNBars; vswpsCount++) {
				jQuery('#vswps-paint').append('<span title="' 
					+ vswpsDataSaveText[vswpsCount] 
					+ '" alt="' 
					+ vswpsDataSaveText[vswpsCount] 
					+ '" style="margin-bottom: 2px;display:block;background-color:' 
					+ vswpsDataSaveColor[vswpsCount] 
					+ ';width:' 
					+ vswpsDataSavePercentage[vswpsCount] 
					+ '%;height:' 
					+ jQuery('#vswps-height-bars').val() 
					+ 'px;" ><span style="position: absolute;padding-left: 5px;color:' 
					+ vswpsDataSaveColorText[vswpsCount] 
					+ ';">' 
					+ vswpsDataSaveText[vswpsCount] 
					+ ' - ' + vswpsDataSavePercentage[vswpsCount] 
					+ '%</span></span>');
			}		
			jQuery('#vswps-paint').fadeIn(3000);
		}
		//ver guardados
		jQuery('.vswps-view-input').click(function() {
			jQuery('#vswps-paint').html('');
			vswpsArraySaved = jQuery('#' + jQuery(this).attr('vswpsid')).attr('viewstatistics').split('vswpstatistics')[1];
			vswpsSavedTitle = vswpsArraySaved.split(',')[1].split('title=')[1];
			vswpsSavedHeight = vswpsArraySaved.split(',')[2].split('height=')[1];
			vswpsSavedPercentage = vswpsArraySaved.split(',')[3].split('percentage=')[1].split('#vswps#');
			vswpsSavedColor = vswpsArraySaved.split(',')[4].split('color=')[1].split('#vswps#');
			vswpsSavedcolorText = vswpsArraySaved.split(',')[5].split('colorText=')[1].split('#vswps#');
			vswpsSavedText = vswpsArraySaved.split(',')[6].split('text=')[1].split('#vswps#');
			jQuery('#vswps-data-save-percentage').val(vswpsSavedPercentage);
			jQuery('#vswps-data-save-color').val(vswpsSavedColor);
			jQuery('#vswps-data-save-color-text').val(vswpsSavedcolorText);
			jQuery('#vswps-data-save-text').val(vswpsSavedText);
			vswpsTitleAndHeight[0] = vswpsSavedTitle;
			vswpsTitleAndHeight[1] = vswpsSavedHeight;
			vswpsTitleAndHeight[2] = vswpsSavedPercentage.length;
			vswpsPreView(vswpsTitleAndHeight);
		});
		//copy code
		jQuery('.vswps-copy-statistics').on('click', function() {
			var aux = document.createElement('input');
			jQuery(aux).val(jQuery(this).attr('copy'));
			document.body.appendChild(aux);
			aux.select();
			document.execCommand('copy');
			document.body.removeChild(aux);
		});
		//on submit sabe data
		jQuery('#vswps-add-statistics').on('submit', function() {
			vswpsArrayPercentage = [];
			jQuery('.vswps-add-percentage-new').each(function () {
				vswpsArrayPercentage.push(jQuery(this).val());
			});
			jQuery('#vswps-data-save-percentage').val(vswpsArrayPercentage);

			vswpsArrayColor = [];
			jQuery('.vswps-add-color-bar-new').each(function () {
				vswpsArrayColor.push(jQuery(this).val());
			});
			jQuery('#vswps-data-save-color').val(vswpsArrayColor);
			
			vswpsArrayColorText = [];
			jQuery('.vswps-add-color-bar-text-new').each(function () {
				vswpsArrayColorText.push(jQuery(this).val());
			});
			jQuery('#vswps-data-save-color-text').val(vswpsArrayColorText);
	
			vswpsArrayText = [];
			jQuery('.vswps-add-text-bar-new').each(function () {
				vswpsArrayText.push(jQuery(this).val());
			});
			jQuery('#vswps-data-save-text').val(vswpsArrayText);
		});
	});
})(jQuery);