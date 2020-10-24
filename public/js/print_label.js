//----------------------------------------------------------------------------
//
//  $Id: PreviewAndPrintLabel.js 11419 2010-04-07 21:18:22Z vbuzuev $
//
// Project -------------------------------------------------------------------
//
//  DYMO Label Framework
//
// Content -------------------------------------------------------------------
//
//  DYMO Label Framework JavaScript Library Samples: Print label
//
//----------------------------------------------------------------------------
//
//  Copyright (c), 2010, Sanford, L.P. All Rights Reserved.
//
//----------------------------------------------------------------------------


/*(function()
{*/
    // called when the document completly loaded
    function create_label(data)
    {
    	//alert(data);
        // prints the label
        /*printButton.onclick = function()
        {*/
            try
            {

                // open label
            	//var labelXml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n<DieCutLabel Version=\"8.0\" Units=\"twips\">\r\n\t<PaperOrientation>Landscape<\/PaperOrientation>\r\n\t<Id>WhiteNameBadge11356<\/Id>\r\n\t<PaperName>11356 White Name Badge - virtual<\/PaperName>\r\n\t<DrawCommands>\r\n\t\t<RoundRectangle X=\"0\" Y=\"0\" Width=\"2340\" Height=\"5040\" Rx=\"270\" Ry=\"270\" \/>\r\n\t<\/DrawCommands>\r\n\t<ObjectInfo>\r\n\t\t<TextObject>\r\n\t\t\t<Name>TEKST<\/Name>\r\n\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" \/>\r\n\t\t\t<LinkedObjectName><\/LinkedObjectName>\r\n\t\t\t<Rotation>Rotation0<\/Rotation>\r\n\t\t\t<IsMirrored>False<\/IsMirrored>\r\n\t\t\t<IsVariable>False<\/IsVariable>\r\n\t\t\t<HorizontalAlignment>Left<\/HorizontalAlignment>\r\n\t\t\t<VerticalAlignment>Top<\/VerticalAlignment>\r\n\t\t\t<TextFitMode>None<\/TextFitMode>\r\n\t\t\t<UseFullFontHeight>True<\/UseFullFontHeight>\r\n\t\t\t<Verticalized>False<\/Verticalized>\r\n\t\t\t<StyledText>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>"+data.order_id+"\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"10\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"10\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>"+data.name+"\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"10\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>"+data.address+"\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"10\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>Opmerking: "+data.remark+"<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"8\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t<\/StyledText>\r\n\t\t<\/TextObject>\r\n\t\t<Bounds X=\"391\" Y=\"278\" Width=\"2910.150390625\" Height=\"1800\" \/>\r\n\t<\/ObjectInfo>\r\n\t<ObjectInfo>\r\n\t\t<TextObject>\r\n\t\t\t<Name>TEKST_1<\/Name>\r\n\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" \/>\r\n\t\t\t<LinkedObjectName><\/LinkedObjectName>\r\n\t\t\t<Rotation>Rotation0<\/Rotation>\r\n\t\t\t<IsMirrored>False<\/IsMirrored>\r\n\t\t\t<IsVariable>False<\/IsVariable>\r\n\t\t\t<HorizontalAlignment>Right<\/HorizontalAlignment>\r\n\t\t\t<VerticalAlignment>Top<\/VerticalAlignment>\r\n\t\t\t<TextFitMode>ShrinkToFit<\/TextFitMode>\r\n\t\t\t<UseFullFontHeight>True<\/UseFullFontHeight>\r\n\t\t\t<Verticalized>False<\/Verticalized>\r\n\t\t\t<StyledText>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>EUR "+data.amount+"\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"10\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>\r\n\r\n\r\n\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"12\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>"+data.date+"<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"10\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t<\/StyledText>\r\n\t\t<\/TextObject>\r\n\t\t<Bounds X=\"3234.05444335938\" Y=\"287.727264404297\" Width=\"1494.54541015625\" Height=\"1560\" \/>\r\n\t<\/ObjectInfo>\r\n<\/DieCutLabel>";
            	//var labelXmlTest = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n<DieCutLabel Version=\"8.0\" Units=\"twips\">\r\n\t<PaperOrientation>Landscape<\/PaperOrientation>\r\n\t<Id>WhiteNameBadge11356<\/Id>\r\n\t<PaperName>11356 White Name Badge - virtual<\/PaperName>\r\n\t<DrawCommands>\r\n\t\t<RoundRectangle X=\"0\" Y=\"0\" Width=\"2340\" Height=\"5040\" Rx=\"270\" Ry=\"270\" \/>\r\n\t<\/DrawCommands>\r\n\t<ObjectInfo>\r\n\t\t<TextObject>\r\n\t\t\t<Name>TEKST<\/Name>\r\n\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" \/>\r\n\t\t\t<LinkedObjectName><\/LinkedObjectName>\r\n\t\t\t<Rotation>Rotation0<\/Rotation>\r\n\t\t\t<IsMirrored>False<\/IsMirrored>\r\n\t\t\t<IsVariable>False<\/IsVariable>\r\n\t\t\t<HorizontalAlignment>Left<\/HorizontalAlignment>\r\n\t\t\t<VerticalAlignment>Top<\/VerticalAlignment>\r\n\t\t\t<TextFitMode>None<\/TextFitMode>\r\n\t\t\t<UseFullFontHeight>True<\/UseFullFontHeight>\r\n\t\t\t<Verticalized>False<\/Verticalized>\r\n\t\t\t<StyledText>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>Order ID 70\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"10\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"10\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>Wikkims\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"10\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>311 Sau Paulo\r\n+1 11-113-4455\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"10\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>Opmerking: No of Persons 20<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"8\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t<\/StyledText>\r\n\t\t<\/TextObject>\r\n\t\t<Bounds X=\"391\" Y=\"278\" Width=\"2910.150390625\" Height=\"1800\" \/>\r\n\t<\/ObjectInfo>\r\n\t<ObjectInfo>\r\n\t\t<TextObject>\r\n\t\t\t<Name>TEKST_1<\/Name>\r\n\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" \/>\r\n\t\t\t<LinkedObjectName><\/LinkedObjectName>\r\n\t\t\t<Rotation>Rotation0<\/Rotation>\r\n\t\t\t<IsMirrored>False<\/IsMirrored>\r\n\t\t\t<IsVariable>False<\/IsVariable>\r\n\t\t\t<HorizontalAlignment>Right<\/HorizontalAlignment>\r\n\t\t\t<VerticalAlignment>Top<\/VerticalAlignment>\r\n\t\t\t<TextFitMode>ShrinkToFit<\/TextFitMode>\r\n\t\t\t<UseFullFontHeight>True<\/UseFullFontHeight>\r\n\t\t\t<Verticalized>False<\/Verticalized>\r\n\t\t\t<StyledText>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>EUR 120\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"10\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>\r\n\r\n\r\n\r\n<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"12\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t\t<Element>\r\n\t\t\t\t\t<String>April 18, 2013<\/String>\r\n\t\t\t\t\t<Attributes>\r\n\t\t\t\t\t\t<Font Family=\"Arial\" Size=\"10\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" \/>\r\n\t\t\t\t\t\t<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" \/>\r\n\t\t\t\t\t<\/Attributes>\r\n\t\t\t\t<\/Element>\r\n\t\t\t<\/StyledText>\r\n\t\t<\/TextObject>\r\n\t\t<Bounds X=\"3234.05444335938\" Y=\"287.727264404297\" Width=\"1494.54541015625\" Height=\"1560\" \/>\r\n\t<\/ObjectInfo>\r\n<\/DieCutLabel>";
            	var labelXml = data;
            	//alert(labelXml);
            	//alert(labelXmlTest);
                //var label = dymo.label.framework.openLabelXml(labelXml);
            	var label = dymo.label.framework.openLabelXml(labelXml);
                var pngData = label.render();
                console.log("data",pngData);
                var labelImage = document.getElementById('labelImage');
                labelImage.src = "data:image/png;base64," + pngData;
            //alert(label);
                // select printer to print on
                // for simplicity sake just use the first LabelWriter printer

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
       // }
    }

    // register onload event
    /*if (window.addEventListener)
        window.addEventListener("load", onload, false);
    else if (window.attachEvent)
        window.attachEvent("onload", onload);
    else
        window.onload = onload;

} ());*/
