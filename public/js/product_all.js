function print_labeler_product_report(prod_id,start,end,print_url)
{
	$.get(print_url,{
		'start_date':start,
		'end_date':end,
		'product_id':prod_id,
	},function(response)
	{

			for(var i=0;i<response.length;i++)
	     	{
	     		var content = response[i];
	     		var proname = [];
	     		var name 	= content.proname;
	     		var count 	= 0;
	     		name 		= name.split( " " );
	     		for (var s = 0; s < name.length; s++) {
	     			if( s == '0' ){
	     				if( name[s].length < 30 ){
	     					proname[count] = name[s];
	     				}
	     			}
	     			else{
	     				var q = proname[count] + " " + name[s];
	     				if( q.length < 30 ){
	     					proname[count] = q;
	     				}
	     				else{
	     					count++;
	     					proname[count] = name[s];
	     				}
	     			}
	     		}

	     		var template = "﻿<"+"?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n\
	     		<DieCutLabel Version=\"8.0\" Units=\"twips\">\
		     		<PaperOrientation>Landscape</PaperOrientation>\
		     		<Id>WhiteNameBadge11356</Id>\
		     		<PaperName>11356 White Name Badge - virtual</PaperName>\
		     		<DrawCommands><RoundRectangle X=\"0\" Y=\"0\" Width=\"2340\" Height=\"5040\" Rx=\"270\" Ry=\"270\" /></DrawCommands>\
		     		<ObjectInfo>\
				 		<TextObject>\
					 		<Name>TEKST</Name>\
					 		<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />\
					 		<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" />\
					 		<LinkedObjectName></LinkedObjectName>\
					 		<Rotation>Rotation0</Rotation>\
					 		<IsMirrored>False</IsMirrored>\
					 		<IsVariable>False</IsVariable>\
					 		<HorizontalAlignment>Left</HorizontalAlignment>\
					 		<VerticalAlignment>Top</VerticalAlignment>\
					 		<TextFitMode>ShrinkToFit</TextFitMode>\
					 		<UseFullFontHeight>True</UseFullFontHeight>\
					 		<Verticalized>False</Verticalized>\
					 		<StyledText>";
			 for (var p = 0; p < proname.length; p++) {
				template 	+=	"<Element>\
							 		<String>"+stripslashes(proname[p])+"\n\n</String>\
							 		<Attributes>\
							 			<Font Family=\"Arial\" Size=\"10\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />\
							 			<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />\
							 		</Attributes>\
						 		</Element>";
			}
				template 	+=	"<Element>\
							 		<String>"+content.default_price+" €\n\n</String>\
							 		<Attributes>\
							 			<Font Family=\"Arial\" Size=\"10\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />\
							 			<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />\
							 		</Attributes>\
							 	</Element>\
						 		<Element>\
							 		<String>"+content.orders_id+"\n</String>\
							 		<Attributes>\
								 		<Font Family=\"Arial\" Size=\"10\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />\
								 		<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />\
							 		</Attributes>\
						 		</Element>\
						 		<Element>\
							 		<String>"+content.client_name+"\n</String>\
							 		<Attributes>\
								 		<Font Family=\"Arial\" Size=\"8\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />\
								 		<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />\
							 		</Attributes>\
						 		</Element>\
						 		<Element>\
						     		<String> "+content.quantity+content.qty_unit+"\n\n</String>\
						     		<Attributes>\
							     		<Font Family=\"Arial\" Size=\"11\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />\
							     		<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />\
						     		</Attributes>\
					     		</Element>\
						 		<Element>\
							 		<String>"+content.order_remarks+"</String>\
							 		<Attributes>\
								 		<Font Family=\"Arial\" Size=\"7\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />\
								 		<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />\
							 		</Attributes>\
						 		</Element>\
					 		</StyledText>\
				 		</TextObject>\
				 		<Bounds X=\"391\" Y=\"100\" Width=\"3828.33227539063\" Height=\"5040\" />\
			 		</ObjectInfo>\
		     		<ObjectInfo>\
			     		<TextObject>\
				     		<Name>TEKST_1</Name>\
				     		<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />\
				     		<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" />\
				     		<LinkedObjectName></LinkedObjectName>\
				     		<Rotation>Rotation0</Rotation>\
				     		<IsMirrored>False</IsMirrored>\
				     		<IsVariable>False</IsVariable>\
				     		<HorizontalAlignment>Right</HorizontalAlignment>\
				     		<VerticalAlignment>Top</VerticalAlignment>\
				     		<TextFitMode>ShrinkToFit</TextFitMode>\
				     		<UseFullFontHeight>True</UseFullFontHeight>\
				     		<Verticalized>False</Verticalized>\
				     		<StyledText>\
					     		<Element>\
						     		<String> "+content.order_pickupdate+"\n</String>\
						     		<Attributes>\
							     		<Font Family=\"Arial\" Size=\"11\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />\
							     		<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />\
						     		</Attributes>\
					     		</Element>\
					     		<Element>\
						     		<String> "+content.order_pickuptime+"</String>\
						     		<Attributes>\
							     		<Font Family=\"Arial\" Size=\"11\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />\
							     		<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />\
						     		</Attributes>\
					     		</Element>\
				     		</StyledText>\
			     		</TextObject>\
		 				<Bounds X=\"3255.87255859375\" Y=\"80.4545364379883\" Width=\"1472.72729492188\" Height=\"1767.27270507813\" />\
		     		</ObjectInfo>\
	     		</DieCutLabel>";
	     		create_label(template);
	     	}

		/*else
		{

		}*/


	},'json'
	);

}
function create_label(data)
{
        try
        {
           	var labelXml = data;
        	var label = dymo.label.framework.openLabelXml(labelXml);
            var printers = dymo.label.framework.getPrinters();
            if (printers.length == 0)
                throw "No DYMO printers are installed. Install DYMO printers.";

            var printerName = "";
            for (var i = 0; i < printers.length; ++i)
            {
                var printer = printers[i];
                if (printer.printerType == "LabelWriterPrinter")
                {
                    printerName = printer.name;
                    break;
                }
            }

            if (printerName == "")
                throw "No LabelWriter printers found. Install LabelWriter printer";

            // finally print the label
            label.print(printerName);
        }
        catch(e)
        {
            alert(e.message || e);
        }

}
function stripslashes (str) {
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Ates Goral (http://magnetiq.com)
    // +      fixed by: Mick@el
    // +   improved by: marrtins
    // +   bugfixed by: Onno Marsman
    // +   improved by: rezna
    // +   input by: Rick Waldron
    // +   reimplemented by: Brett Zamir (http://brett-zamir.me)
    // +   input by: Brant Messenger (http://www.brantmessenger.com/)
    // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
    // *     example 1: stripslashes('Kevin\'s code');
    // *     returns 1: "Kevin's code"
    // *     example 2: stripslashes('Kevin\\\'s code');
    // *     returns 2: "Kevin\'s code"
    return (str + '').replace(/\\(.?)/g, function (s, n1) {
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
