var timer = setTimeout(function() {
	  window.location = window.location;
	}, 60000);
	$(function(){
	  $("#btn_auto_load").click(function(e){
	    e.preventDefault();
	    clearTimeout(timer);
	  });
	});


	function close_this_noti(noti_id){
		var id = parseInt(noti_id.substring(5));
		$.ajax({
			url:base_url+'cp/cdashboard/close_notification/'+id,
			dataType: 'json',
			success:function(response){

			}
		});
		$("#"+noti_id).parent('div').hide('slow');
	}
	var labeler_activated = false;


	function print_labeler(orders_id,type){

			$.ajax({
				url:base_url+'cp/orders/print_labeler/'+orders_id+'/'+type,
				dataType: 'json',
				success:function(response){

						if(response.error){
							alert(response.message);
						}else{
							if(response.message == 'array'){

								for(var j=0;j<response.data.length;j++){

									var content = response.data[j];
									// At webby
									//var template = "﻿<"+"?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n<DieCutLabel Version=\"8.0\" Units=\"twips\"><PaperOrientation>Landscape</PaperOrientation><Id>WhiteNameBadge11356</Id><PaperName>11356 White Name Badge - virtual</PaperName><DrawCommands><RoundRectangle X=\"0\" Y=\"0\" Width=\"2340\" Height=\"5040\" Rx=\"270\" Ry=\"270\" /></DrawCommands><ObjectInfo><TextObject><Name>TEKST</Name><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /><BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" /><LinkedObjectName></LinkedObjectName><Rotation>Rotation0</Rotation><IsMirrored>False</IsMirrored><IsVariable>False</IsVariable><HorizontalAlignment>Left</HorizontalAlignment><VerticalAlignment>Top</VerticalAlignment><TextFitMode>None</TextFitMode><UseFullFontHeight>True</UseFullFontHeight><Verticalized>False</Verticalized><StyledText><Element><String>"+content.name+"\n\n</String><Attributes><Font Family=\"Arial\" Size=\"10\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element><Element><String></String><Attributes><Font Family=\"Arial\" Size=\"10\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element><Element><String>"+content.extra+"</String><Attributes><Font Family=\"Arial\" Size=\"7\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element><Element><String></String><Attributes><Font Family=\"Arial\" Size=\"8\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element><Element><String>"+content.remark+"</String><Attributes><Font Family=\"Arial\" Size=\"7\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element></StyledText></TextObject><Bounds X=\"391\" Y=\"136.181823730469\" Width=\"3128.33227539063\" Height=\"2094.54541015625\" /></ObjectInfo><ObjectInfo><TextObject><Name>TEKST_1</Name><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /><BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" /><LinkedObjectName></LinkedObjectName><Rotation>Rotation0</Rotation><IsMirrored>False</IsMirrored><IsVariable>False</IsVariable><HorizontalAlignment>Right</HorizontalAlignment><VerticalAlignment>Top</VerticalAlignment><TextFitMode>ShrinkToFit</TextFitMode><UseFullFontHeight>True</UseFullFontHeight><Verticalized>False</Verticalized><StyledText><Element><String>€</String><Attributes><Font Family=\"Arial\" Size=\"8\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element><Element><String> "+content.amount+"</String><Attributes><Font Family=\"Arial\" Size=\"11\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element></StyledText></TextObject><Bounds X=\"3255.87255859375\" Y=\"80.4545364379883\" Width=\"1472.72729492188\" Height=\"1767.27270507813\" /></ObjectInfo><ObjectInfo><TextObject><Name>TEXT</Name><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /><BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" /><LinkedObjectName></LinkedObjectName><Rotation>Rotation0</Rotation><IsMirrored>False</IsMirrored><IsVariable>False</IsVariable><HorizontalAlignment>Right</HorizontalAlignment><VerticalAlignment>Top</VerticalAlignment><TextFitMode>ShrinkToFit</TextFitMode><UseFullFontHeight>True</UseFullFontHeight><Verticalized>False</Verticalized><StyledText><Element><String>"+content.c_name+"</String><Attributes><Font Family=\"Arial\" Size=\"8\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element></StyledText></TextObject><Bounds X=\"2291.7817327326\" Y=\"1990.90909090909\" Width=\"2443.63636363636\" Height=\"250.909090909091\" /></ObjectInfo></DieCutLabel>";

									// At Live
									//var template = "﻿<"+"?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n<DieCutLabel Version=\"8.0\" Units=\"twips\"><PaperOrientation>Landscape</PaperOrientation><Id>WhiteNameBadge11356</Id><PaperName>11356 White Name Badge - virtual</PaperName><DrawCommands><RoundRectangle X=\"0\" Y=\"0\" Width=\"2340\" Height=\"5040\" Rx=\"270\" Ry=\"270\" /></DrawCommands><ObjectInfo><TextObject><Name>TEKST</Name><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /><BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" /><LinkedObjectName></LinkedObjectName><Rotation>Rotation0</Rotation><IsMirrored>False</IsMirrored><IsVariable>False</IsVariable><HorizontalAlignment>Left</HorizontalAlignment><VerticalAlignment>Top</VerticalAlignment><TextFitMode>None</TextFitMode><UseFullFontHeight>True</UseFullFontHeight><Verticalized>False</Verticalized><StyledText><Element><String>"+content.name+" ("+content.default_price+" €)\n\n</String><Attributes><Font Family=\"Arial\" Size=\"10\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element><Element><String></String><Attributes><Font Family=\"Arial\" Size=\"10\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element><Element><String>"+content.c_name+"\n\n</String><Attributes><Font Family=\"Arial\" Size=\"8\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element><Element><String></String><Attributes><Font Family=\"Arial\" Size=\"10\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element><Element><String>"+content.extra+"</String><Attributes><Font Family=\"Arial\" Size=\"7\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element><Element><String></String><Attributes><Font Family=\"Arial\" Size=\"8\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element><Element><String>"+content.remark+"</String><Attributes><Font Family=\"Arial\" Size=\"7\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element></StyledText></TextObject><Bounds X=\"391\" Y=\"136.181823730469\" Width=\"3128.33227539063\" Height=\"2094.54541015625\" /></ObjectInfo><ObjectInfo><TextObject><Name>TEKST_1</Name><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /><BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" /><LinkedObjectName></LinkedObjectName><Rotation>Rotation0</Rotation><IsMirrored>False</IsMirrored><IsVariable>False</IsVariable><HorizontalAlignment>Right</HorizontalAlignment><VerticalAlignment>Top</VerticalAlignment><TextFitMode>ShrinkToFit</TextFitMode><UseFullFontHeight>True</UseFullFontHeight><Verticalized>False</Verticalized><StyledText><Element><String>€</String><Attributes><Font Family=\"Arial\" Size=\"8\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element><Element><String> "+content.amount+"</String><Attributes><Font Family=\"Arial\" Size=\"11\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element></StyledText></TextObject><Bounds X=\"3255.87255859375\" Y=\"80.4545364379883\" Width=\"1472.72729492188\" Height=\"1767.27270507813\" /></ObjectInfo></DieCutLabel>";
									//var template = "﻿<"+"?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n<DieCutLabel Version=\"8.0\" Units=\"twips\"><PaperOrientation>Landscape</PaperOrientation><Id>WhiteNameBadge11356</Id><PaperName>11356 White Name Badge - virtual</PaperName><DrawCommands><RoundRectangle X=\"0\" Y=\"0\" Width=\"2340\" Height=\"5040\" Rx=\"270\" Ry=\"270\" /></DrawCommands><ObjectInfo><TextObject><Name>TEKST</Name><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /><BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" /><LinkedObjectName></LinkedObjectName><Rotation>Rotation0</Rotation><IsMirrored>False</IsMirrored><IsVariable>False</IsVariable><HorizontalAlignment>Left</HorizontalAlignment><VerticalAlignment>Top</VerticalAlignment><TextFitMode>ShrinkToFit</TextFitMode><UseFullFontHeight>True</UseFullFontHeight><Verticalized>False</Verticalized><StyledText><Element><String>"+content.name+" ("+content.default_price+" €)\n\n</String><Attributes><Font Family=\"Arial\" Size=\"10\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element><Element><String></String><Attributes><Font Family=\"Arial\" Size=\"10\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element><Element><String>"+( (content.company != '')?content.company:'')+"\n</String><Attributes><Font Family=\"Arial\" Size=\"8\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element><Element><String>"+content.c_name+"\n\n</String><Attributes><Font Family=\"Arial\" Size=\"8\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element><Element><String></String><Attributes><Font Family=\"Arial\" Size=\"10\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element><Element><String>"+content.extra+"</String><Attributes><Font Family=\"Arial\" Size=\"7\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element><Element><String></String><Attributes><Font Family=\"Arial\" Size=\"8\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element><Element><String>"+content.remark+"</String><Attributes><Font Family=\"Arial\" Size=\"7\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element><Element><String>"+content.extra_field_text+"</String><Attributes><Font Family=\"Arial\" Size=\"7\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element></StyledText></TextObject><Bounds X=\"391\" Y=\"136.181823730469\" Width=\"3828.33227539063\" Height=\"5040\" /></ObjectInfo><ObjectInfo><TextObject><Name>TEKST_1</Name><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /><BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" /><LinkedObjectName></LinkedObjectName><Rotation>Rotation0</Rotation><IsMirrored>False</IsMirrored><IsVariable>False</IsVariable><HorizontalAlignment>Right</HorizontalAlignment><VerticalAlignment>Top</VerticalAlignment><TextFitMode>ShrinkToFit</TextFitMode><UseFullFontHeight>True</UseFullFontHeight><Verticalized>False</Verticalized><StyledText><Element><String>€</String><Attributes><Font Family=\"Arial\" Size=\"8\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element><Element><String> "+content.amount+"</String><Attributes><Font Family=\"Arial\" Size=\"11\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element></StyledText></TextObject><Bounds X=\"3255.87255859375\" Y=\"80.4545364379883\" Width=\"1472.72729492188\" Height=\"1767.27270507813\" /></ObjectInfo></DieCutLabel>";
									var template = "﻿<"+"?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n<DieCutLabel Version=\"8.0\" Units=\"twips\"><PaperOrientation>Landscape</PaperOrientation><Id>WhiteNameBadge11356</Id><PaperName>11356 White Name Badge - virtual</PaperName><DrawCommands><RoundRectangle X=\"0\" Y=\"0\" Width=\"2340\" Height=\"5040\" Rx=\"270\" Ry=\"270\" /></DrawCommands><ObjectInfo><TextObject><Name>TEKST</Name><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /><BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" /><LinkedObjectName></LinkedObjectName><Rotation>Rotation0</Rotation><IsMirrored>False</IsMirrored><IsVariable>False</IsVariable><HorizontalAlignment>Left</HorizontalAlignment><VerticalAlignment>Top</VerticalAlignment><TextFitMode>ShrinkToFit</TextFitMode><UseFullFontHeight>True</UseFullFontHeight><Verticalized>False</Verticalized><StyledText><Element><String>"+content.name+" ("+content.default_price+" €)\n\n</String><Attributes><Font Family=\"Arial\" Size=\"10\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element><Element><String></String><Attributes><Font Family=\"Arial\" Size=\"10\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element><Element><String>"+( (content.company != '')?content.company:'')+"\n</String><Attributes><Font Family=\"Arial\" Size=\"8\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element><Element><String>"+content.c_name+"\n\n</String><Attributes><Font Family=\"Arial\" Size=\"8\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element><Element><String></String><Attributes><Font Family=\"Arial\" Size=\"10\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element><Element><String>"+content.extra_field_text+"\n</String><Attributes><Font Family=\"Arial\" Size=\"7\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element><Element><String>"+content.extra+"</String><Attributes><Font Family=\"Arial\" Size=\"7\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element><Element><String></String><Attributes><Font Family=\"Arial\" Size=\"8\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element><Element><String>"+content.remark+"</String><Attributes><Font Family=\"Arial\" Size=\"7\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element></StyledText></TextObject><Bounds X=\"391\" Y=\"100\" Width=\"3828.33227539063\" Height=\"5040\" /></ObjectInfo><ObjectInfo><TextObject><Name>TEKST_1</Name><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /><BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" /><LinkedObjectName></LinkedObjectName><Rotation>Rotation0</Rotation><IsMirrored>False</IsMirrored><IsVariable>False</IsVariable><HorizontalAlignment>Right</HorizontalAlignment><VerticalAlignment>Top</VerticalAlignment><TextFitMode>ShrinkToFit</TextFitMode><UseFullFontHeight>True</UseFullFontHeight><Verticalized>False</Verticalized><StyledText><Element><String>€</String><Attributes><Font Family=\"Arial\" Size=\"8\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element><Element><String> "+content.amount+"</String><Attributes><Font Family=\"Arial\" Size=\"11\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" /><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /></Attributes></Element></StyledText></TextObject><Bounds X=\"3255.87255859375\" Y=\"80.4545364379883\" Width=\"1472.72729492188\" Height=\"1767.27270507813\" /></ObjectInfo></DieCutLabel>";
									//alert(template);
									create_label(template);

								}
							}else{
								var content = response.data;

								// At webby
								//var template = "<"+"?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n<DieCutLabel Version=\"8.0\" Units=\"twips\">\r\n\t<PaperOrientation>Landscape<\/PaperOrientation>\r\n\t<Id>WhiteNameBadge11356<\/Id>\r\n\t<PaperName>11356 White Name Badge - virtual<\/PaperName>\r\n\t<DrawCommands>\r\n\t\t<RoundRectangle X=\"0\" Y=\"0\" Width=\"2340\" Height=\"5040\" Rx=\"270\" Ry=\"270\" \/>\r\n\t<\/DrawCommands>\r\n\t<ObjectInfo>\r\n\t\t<TextObject>\r\n\t\t\t<Name>TEKST<\/Name>\r\n\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" \/>\r\n\t\t\t<LinkedObjectName><\/LinkedObjectName>\r\n\t\t\t<Rotation>Rotation0<\/Rotation>\r\n\t\t\t<IsMirrored>False<\/IsMirrored>\r\n\t\t\t<IsVariable>False<\/IsVariable>\r\n\t\t\t<HorizontalAlignment>Left<\/HorizontalAlignment>\r\n\t\t\t<VerticalAlignment>Top<\/VerticalAlignment>\r\n\t\t\t<TextFitMode>None<\/TextFitMode>\r\n\t\t\t<UseFullFontHeight>True<\/UseFullFontHeight>\r\n\t\t\t<Verticalized>False<\/Verticalized>\r\n\t\t\t<StyledText>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>ID "+content.order_id+"\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"10\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"10\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>"+content.name+"\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"8\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>"+content.address+"\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"7\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t<\/StyledText>\r\n\t\t<\/TextObject>\r\n\t\t<Bounds X=\"391\" Y=\"278\" Width=\"2910.150390625\" Height=\"1600\" \/>\r\n\t<\/ObjectInfo>\r\n\t<ObjectInfo>\r\n\t\t<TextObject>\r\n\t\t\t<Name>TEKST_1<\/Name>\r\n\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" \/>\r\n\t\t\t<LinkedObjectName><\/LinkedObjectName>\r\n\t\t\t<Rotation>Rotation0<\/Rotation>\r\n\t\t\t<IsMirrored>False<\/IsMirrored>\r\n\t\t\t<IsVariable>False<\/IsVariable>\r\n\t\t\t<HorizontalAlignment>Right<\/HorizontalAlignment>\r\n\t\t\t<VerticalAlignment>Top<\/VerticalAlignment>\r\n\t\t\t<TextFitMode>ShrinkToFit<\/TextFitMode>\r\n\t\t\t<UseFullFontHeight>True<\/UseFullFontHeight>\r\n\t\t\t<Verticalized>False<\/Verticalized>\r\n\t\t\t<StyledText>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>€ "+content.amount+"\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"10\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>\r\n\r\n\r\n\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"12\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>"+content.date+"<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"10\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t<\/StyledText>\r\n\t\t<\/TextObject>\r\n\t\t<Bounds X=\"3234.05444335938\" Y=\"287.727264404297\" Width=\"1494.54541015625\" Height=\"1560\" \/>\r\n\t<\/ObjectInfo>\r\n\t<ObjectInfo>\r\n\t\t<TextObject>\r\n\t\t\t<Name>TEKST_3<\/Name>\r\n\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" \/>\r\n\t\t\t<LinkedObjectName><\/LinkedObjectName>\r\n\t\t\t<Rotation>Rotation0<\/Rotation>\r\n\t\t\t<IsMirrored>False<\/IsMirrored>\r\n\t\t\t<IsVariable>False<\/IsVariable>\r\n\t\t\t<HorizontalAlignment>Left<\/HorizontalAlignment>\r\n\t\t\t<VerticalAlignment>Bottom<\/VerticalAlignment>\r\n\t\t\t<TextFitMode>None<\/TextFitMode>\r\n\t\t\t<UseFullFontHeight>True<\/UseFullFontHeight>\r\n\t\t\t<Verticalized>False<\/Verticalized>\r\n\t\t\t<StyledText>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>"+content.remark+"\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"7\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t<\/StyledText>\r\n\t\t<\/TextObject>\r\n\t\t<Bounds X=\"391\" Y=\"278\" Width=\"2910.150390625\" Height=\"1600\" \/>\r\n\t<\/ObjectInfo>\r\n<\/DieCutLabel>";

								// At Live
								//var template = "<"+"?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n<DieCutLabel Version=\"8.0\" Units=\"twips\">\r\n\t<PaperOrientation>Landscape<\/PaperOrientation>\r\n\t<Id>WhiteNameBadge11356<\/Id>\r\n\t<PaperName>11356 White Name Badge - virtual<\/PaperName>\r\n\t<DrawCommands>\r\n\t\t<RoundRectangle X=\"0\" Y=\"0\" Width=\"2340\" Height=\"5040\" Rx=\"270\" Ry=\"270\" \/>\r\n\t<\/DrawCommands>\r\n\t<ObjectInfo>\r\n\t\t<TextObject>\r\n\t\t\t<Name>TEKST<\/Name>\r\n\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" \/>\r\n\t\t\t<LinkedObjectName><\/LinkedObjectName>\r\n\t\t\t<Rotation>Rotation0<\/Rotation>\r\n\t\t\t<IsMirrored>False<\/IsMirrored>\r\n\t\t\t<IsVariable>False<\/IsVariable>\r\n\t\t\t<HorizontalAlignment>Left<\/HorizontalAlignment>\r\n\t\t\t<VerticalAlignment>Top<\/VerticalAlignment>\r\n\t\t\t<TextFitMode>None<\/TextFitMode>\r\n\t\t\t<UseFullFontHeight>True<\/UseFullFontHeight>\r\n\t\t\t<Verticalized>False<\/Verticalized>\r\n\t\t\t<StyledText>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>ID "+content.order_id+"\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"10\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"10\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>"+content.name+"\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"8\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>"+content.address+"\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"7\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t<\/StyledText>\r\n\t\t<\/TextObject>\r\n\t\t<Bounds X=\"391\" Y=\"278\" Width=\"2910.150390625\" Height=\"1600\" \/>\r\n\t<\/ObjectInfo>\r\n\t<ObjectInfo>\r\n\t\t<TextObject>\r\n\t\t\t<Name>TEKST_1<\/Name>\r\n\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" \/>\r\n\t\t\t<LinkedObjectName><\/LinkedObjectName>\r\n\t\t\t<Rotation>Rotation0<\/Rotation>\r\n\t\t\t<IsMirrored>False<\/IsMirrored>\r\n\t\t\t<IsVariable>False<\/IsVariable>\r\n\t\t\t<HorizontalAlignment>Right<\/HorizontalAlignment>\r\n\t\t\t<VerticalAlignment>Top<\/VerticalAlignment>\r\n\t\t\t<TextFitMode>ShrinkToFit<\/TextFitMode>\r\n\t\t\t<UseFullFontHeight>True<\/UseFullFontHeight>\r\n\t\t\t<Verticalized>False<\/Verticalized>\r\n\t\t\t<StyledText>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>€ "+content.amount+"\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"10\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>\r\n\r\n\r\n\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"12\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>"+content.date+"<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"10\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t<\/StyledText>\r\n\t\t<\/TextObject>\r\n\t\t<Bounds X=\"3234.05444335938\" Y=\"287.727264404297\" Width=\"1494.54541015625\" Height=\"1560\" \/>\r\n\t<\/ObjectInfo>\r\n\t<ObjectInfo>\r\n\t\t<TextObject>\r\n\t\t\t<Name>TEKST_3<\/Name>\r\n\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" \/>\r\n\t\t\t<LinkedObjectName><\/LinkedObjectName>\r\n\t\t\t<Rotation>Rotation0<\/Rotation>\r\n\t\t\t<IsMirrored>False<\/IsMirrored>\r\n\t\t\t<IsVariable>False<\/IsVariable>\r\n\t\t\t<HorizontalAlignment>Left<\/HorizontalAlignment>\r\n\t\t\t<VerticalAlignment>Bottom<\/VerticalAlignment>\r\n\t\t\t<TextFitMode>None<\/TextFitMode>\r\n\t\t\t<UseFullFontHeight>True<\/UseFullFontHeight>\r\n\t\t\t<Verticalized>False<\/Verticalized>\r\n\t\t\t<StyledText>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>"+content.remark+"\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"7\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t<\/StyledText>\r\n\t\t<\/TextObject>\r\n\t\t<Bounds X=\"391\" Y=\"278\" Width=\"2910.150390625\" Height=\"1600\" \/>\r\n\t<\/ObjectInfo>\r\n<\/DieCutLabel>";
								var template = "<"+"?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n<DieCutLabel Version=\"8.0\" Units=\"twips\">\r\n\t<PaperOrientation>Landscape<\/PaperOrientation>\r\n\t<Id>WhiteNameBadge11356<\/Id>\r\n\t<PaperName>11356 White Name Badge - virtual<\/PaperName>\r\n\t<DrawCommands>\r\n\t\t<RoundRectangle X=\"0\" Y=\"0\" Width=\"2340\" Height=\"5040\" Rx=\"270\" Ry=\"270\" \/>\r\n\t<\/DrawCommands>\r\n\t<ObjectInfo>\r\n\t\t<TextObject>\r\n\t\t\t<Name>TEKST<\/Name>\r\n\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" \/>\r\n\t\t\t<LinkedObjectName><\/LinkedObjectName>\r\n\t\t\t<Rotation>Rotation0<\/Rotation>\r\n\t\t\t<IsMirrored>False<\/IsMirrored>\r\n\t\t\t<IsVariable>False<\/IsVariable>\r\n\t\t\t<HorizontalAlignment>Left<\/HorizontalAlignment>\r\n\t\t\t<VerticalAlignment>Top<\/VerticalAlignment>\r\n\t\t\t<TextFitMode>None<\/TextFitMode>\r\n\t\t\t<UseFullFontHeight>True<\/UseFullFontHeight>\r\n\t\t\t<Verticalized>False<\/Verticalized>\r\n\t\t\t<StyledText>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>ID "+content.order_id+"\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"10\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String> "+( (content.company_c != '')?content.company_c:'')+"\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"10\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t</Element><Element>\r\n\t\t\t\t\t<String>\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"10\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>"+content.name+"\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"8\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>"+content.address+"\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"7\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t<\/StyledText>\r\n\t\t<\/TextObject>\r\n\t\t<Bounds X=\"391\" Y=\"100\" Width=\"2910.150390625\" Height=\"1600\" \/>\r\n\t<\/ObjectInfo>\r\n\t<ObjectInfo>\r\n\t\t<TextObject>\r\n\t\t\t<Name>TEKST_1<\/Name>\r\n\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" \/>\r\n\t\t\t<LinkedObjectName><\/LinkedObjectName>\r\n\t\t\t<Rotation>Rotation0<\/Rotation>\r\n\t\t\t<IsMirrored>False<\/IsMirrored>\r\n\t\t\t<IsVariable>False<\/IsVariable>\r\n\t\t\t<HorizontalAlignment>Right<\/HorizontalAlignment>\r\n\t\t\t<VerticalAlignment>Top<\/VerticalAlignment>\r\n\t\t\t<TextFitMode>ShrinkToFit<\/TextFitMode>\r\n\t\t\t<UseFullFontHeight>True<\/UseFullFontHeight>\r\n\t\t\t<Verticalized>False<\/Verticalized>\r\n\t\t\t<StyledText>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>€ "+content.amount+"\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"10\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>\r\n\r\n\r\n\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"12\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>"+content.date+"<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"10\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t<\/StyledText>\r\n\t\t<\/TextObject>\r\n\t\t<Bounds X=\"3234.05444335938\" Y=\"287.727264404297\" Width=\"1494.54541015625\" Height=\"1560\" \/>\r\n\t<\/ObjectInfo>\r\n\t<ObjectInfo>\r\n\t\t<TextObject>\r\n\t\t\t<Name>TEKST_3<\/Name>\r\n\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" \/>\r\n\t\t\t<LinkedObjectName><\/LinkedObjectName>\r\n\t\t\t<Rotation>Rotation0<\/Rotation>\r\n\t\t\t<IsMirrored>False<\/IsMirrored>\r\n\t\t\t<IsVariable>False<\/IsVariable>\r\n\t\t\t<HorizontalAlignment>Left<\/HorizontalAlignment>\r\n\t\t\t<VerticalAlignment>Bottom<\/VerticalAlignment>\r\n\t\t\t<TextFitMode>None<\/TextFitMode>\r\n\t\t\t<UseFullFontHeight>True<\/UseFullFontHeight>\r\n\t\t\t<Verticalized>False<\/Verticalized>\r\n\t\t\t<StyledText>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>"+content.remark+"\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"7\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t<\/StyledText>\r\n\t\t<\/TextObject>\r\n\t\t<Bounds X=\"391\" Y=\"278\" Width=\"2910.150390625\" Height=\"1600\" \/>\r\n\t<\/ObjectInfo>\r\n<\/DieCutLabel>";

								//var template = "<"+"?xml version=\"1.0\" encoding=\"utf-8\"?><DieCutLabel Version=\"8.0\" Units=\"twips\"><PaperOrientation>Landscape</PaperOrientation><Id>Address</Id><PaperName>30252 Address</PaperName><DrawCommands><RoundRectangle X=\"0\" Y=\"0\" Width=\"1581\" Height=\"5040\" Rx=\"270\" Ry=\"270\" /></DrawCommands><ObjectInfo><ImageObject><Name>Image</Name><ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /><BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" /><LinkedObjectName></LinkedObjectName><Rotation>Rotation0</Rotation><IsMirrored>False</IsMirrored><IsVariable>False</IsVariable><ImageLocation>http://webilyst.com/projects/bolive/assets/cp/images/move.png<ImageLocation/><ScaleMode>Fill</ScaleMode><BorderWidth>0</BorderWidth><BorderColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" /><HorizontalAlignment>Left</HorizontalAlignment><VerticalAlignment>Top</VerticalAlignment></ImageObject><Bounds X=\"331\" Y=\"57.9999999999999\" Width=\"1440\" Height=\"1440\" /></ObjectInfo></DieCutLabel>";
								//alert(template);
								create_label(template);
							}
						}
					}
			});
		}
<!-- ----------------------------------------------------------- -->

<!-- -----/*function will show div that contains the purchases*/------ -->
	function show_purchases(orders_id){
		$.post(base_url+'cp/orders/lijst',{'act':'show_order_details','orders_id':orders_id},function(data){
			$('#show_order_details').html(data);
			tb_show('Details','TB_inline?height=300&width=650&inlineId=show_order_details',null);
		});
	}
<!-- ----------------------------------------------------------- -->

<!-- -----function that will reload the page----- -->
	function all_orders(){
  		window.location =base_url+"cp/orders";
  	}
<!-- ------------------------------------------- -->

<!-- -----------------function to show pop up for a single order to print---------------- -->
	function print_Popup(id){

		window.open(base_url+"cp/orders/print_order_details?id="+id+"&print_count=single", "myWindow", "status = 1, height = 600, width = 550, resizable = 1, scrollbars=yes, left=10, top=100" );
	}
<!---------------------------------------------------------------------------------------->

<!-- -----------------function that will check all the checkbox---------------------- -->
	function select_all(id1, id2, start_index,end_index){
		if(document.getElementById(id1).checked == true){
			for(i=parseInt(start_index); i<parseInt(end_index); i++){
				id = id2+i;
				document.getElementById(id).checked = true;
			}
		}else{
			for(i=parseInt(start_index); i<end_index; i++){
				id = id2+i;
				document.getElementById(id).checked = false;
			}
		}
 	}
<!-- --------------------------------------------------------------------------------- -->

<!-- -------------------function invoked when delete all is clicked--------------------- -->
	function ValidateSelection(frm, id1,start_index,end_index){
		var x=true;
		for(var i=parseInt(start_index);i<parseInt(end_index);i++){
			var id = id1 + i;
			//alert(id+'   '+document.getElementById(id).value);
			if(document.getElementById(id).checked){
				x=false;
				confirmDel(frm);
				break;
			}
		}
		if(x){
			alert(messages1);
		}
		return false;
	}

	function confirmDel(frm){
		if(confirm(messages2)){
			var delete_all=new Array();
			var arr=document.getElementsByName("del[]");

			var j=0;
			for(i=0;i<arr.length;i++){
				var obj=document.getElementsByName('del[]').item(i);
				if(obj.checked){
					delete_all[j]=obj.value;
					j++;
				}
			}
			order_ids=delete_all.toString();
			$.post(base_url+'cp/orders',{'act':'delete_order','delete_row':'all','order_ids':order_ids},            function(data){
				if(data=='success'){
					alert(messages3);
					window.location=base_url+'cp/orders';
				}else if(data=='error'){
					alert(messages4);
				}
			});




		}
	}
<!-- ---------------------------------------------------------------------- -->

<!-- -------------function invoked when print all is clicked--------------- -->
	function ValidateSelection1(frm, id1, start_index,end_index){
		var x=true;
		for(var i=parseInt(start_index);i<parseInt(end_index);i++){
			var id = id1 + i;
			//alert(document.getElementById(id).value);
			if(document.getElementById(id).checked){
				x=false;
				confirmPrintAll(frm);
				break;
			}
		}
		if(x){
			alert(messages6);
		}
			return false;
	}

	function confirmPrintAll(frm){
		if(confirm(messages7)){
			var print_all = new Array();
			var arr = document.getElementsByName("del[]");
			var j =0;
			for(var i = 0; i < arr.length; i++){
            	var obj = document.getElementsByName("del[]").item(i);
				if(obj.checked){
					print_all[j] = obj.value;
					j++;
				}
			}
			var order_ids=print_all.toString();
			/*$.post('<?php echo base_url?>cp/cdashboard/orders',{'act':'print_order','print_count':'all','order_ids':order_ids},function(data){
				var my_window=window.open( "", "myWindow", "status = 1, height = 600, width = 550, resizable = 1, scrollbars=yes, left=10, top=100" );
				$(my_window.document).find("body").html(data);

			}); */

			<!--this will open a new window -->
			window.open( base_url+"cp/orders/print_order_details?order_ids="+order_ids+"&print_count=all", "myWindow", "status = 1, height = 600, width = 550, resizable = 1, scrollbars=yes, left=10, top=100" );

		}
	}
<!-- ------------------------------------------------------------------------------- -->
/*-------------function to show thick box when  client's name is clicked -----------*/
	function show_client_data(order_id){
		tb_show('Details','#TB_inline?height=290&width=400&inlineId=show_client_'+order_id,'');
	}
/*----------------------------------------------------------------------------------*/






var members = new Array();


function urldecode(str)
{
     if(str)
	 return unescape(str.replace(/\+/g, " "));
	 else
	 return '';
}

/* -------------------- FUNCTION TO STRIP SLASHES ------------------------------------------ */
function stripslashes(str) {
	//        example 1: stripslashes('Kevin\'s code');
	//        returns 1: "Kevin's code"
	//        example 2: stripslashes('Kevin\\\'s code');
	//        returns 2: "Kevin\'s code"

	return (str + '')
	    .replace(/\\(.?)/g, function(s, n1) {
	      switch (n1) {
	        case '\\':
	          return '\\';
	        case '0':
	          return '\u0000';
	        case '':
	          return '';
	        default:
	          return n1;
	     }
	});
}

function getOptionsFromForm(){
	var opt = {callback: pageselectCallback};

	opt['items_per_page'] = 10;

	opt['num_display_entries'] = 4;

	opt['num_edge_entries'] = 2;

	opt['prev_text'] = 'Prev';

	opt['next_text'] = 'Next';

	return opt;

}

$(document).ready(function(){


	$("#no_accept").on('click',function(){
		window.location = base_url+'cp/login/logout';
	});

	$("#accept").on('click',function(){
		$.post(
				base_url+'cp/cdashboard/accept_mail_from_bestelonline',
				{},
				function(response){
					self.parent.tb_remove();
				}
		);

	});

	var optInit = getOptionsFromForm();
    $("#Pagination").pagination(dataLength, optInit);
});
