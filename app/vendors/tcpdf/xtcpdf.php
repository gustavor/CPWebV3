<?php
App::import('Vendor','tcpdf/tcpdf');
class XTCPDF  extends TCPDF
{

    var $xheadertext  = 'PDF criado usando CakePHP and TCPDF';
    var $xheadercolor = array(0,0,200);
    var $xfootertext  = '@copyright Copyright 2010, Valéria Esteves Advogados Associados ( www.veadvogados.com.br )';
    var $xfooterfont  = PDF_FONT_NAME_MAIN ;
    var $xfooterfontsize = 8 ;
    var $xheadersubtext = '';


    /**
    * Overwrites the default header
    * set the text in the view using
    *    $fpdf->xheadertext = 'YOUR ORGANIZATION';
    * set the fill color in the view using
    *    $fpdf->xheadercolor = array(0,0,100); (r, g, b)
    * set the font in the view using
    *    $fpdf->setHeaderFont(array('YourFont','',fontsize));
    */
    function Header()
    {

        list($r, $b, $g) = $this->xheadercolor;
        $this->setY(10); // shouldn't be needed due to page margin, but helas, otherwise it's at the page top
        $this->SetFillColor($r, $b, $g);
        $this->SetTextColor(0 , 0, 0);
        $this->Text(15,10,$this->xheadertext );
        $this->ln();
        if (!empty($this->xheadersubtext)) $this->Text($this->xheadersubtext);
    }

    /**
    * Overwrites the default footer
    * set the text in the view using
    * $fpdf->xfootertext = 'Copyright Â© %d YOUR ORGANIZATION. All rights reserved.';
    */
    function Footer()
    {
        $year = date('Y');
        $footertext = sprintf($this->xfootertext, $year);
        $this->SetY(-20);
        $this->SetTextColor(0, 0, 0);
        $this->SetFont($this->xfooterfont,'',$this->xfooterfontsize);
        $this->Cell(0,8, $footertext,'T',1,'C');
    }
}
?>
