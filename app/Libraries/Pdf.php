<?php

namespace App\Libraries;

use TCPDF;

class Pdf extends TCPDF
{

    public function Header()
    {
        $logoX = 7; // Adjust as needed
        $logoFileName = FCPATH . 'frontend/assets/img/logodisnakertransmkw.png'; // Adjust path as needed
        $logoWidth = 40; // Adjust as needed

        // Set font
        $this->SetFont('helvetica', 'I', 7);
        $this->Image($logoFileName, $logoX, 5, $logoWidth);
    }

    public function Footer()
    {
        $this->SetY(-15); // Set position for footer

        // Set font
        $this->SetFont('helvetica', 'I', 7);

        // Footer text
        $footerText = '
            <table border="0" width="100%">
                <tr>
                    <td align="left"></td>
                    <td align="center">Page ' . $this->getAliasNumPage() . ' of ' . $this->getAliasNbPages() . '</td>
                    <td align="right">Copyright &copy; ' . date('Y') . ' DisnakertransMkw. All rights reserved.</td>
                </tr>
                <tr>
                    <td align="left"></td>
                    <td align="center"></td>
                    <td align="right">Print date: ' . date('d-m-Y H:i:s') . '</td>
                </tr>
            </table>';

        $this->writeHTML($footerText, true, false, true, false, '');
    }
}
