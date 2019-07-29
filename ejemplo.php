<?php
/**
 * HTML2PDF Librairy - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @author      Laurent MINGUET <webmaster@html2pdf.fr>
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */
    // get the HTML
    ob_start();

    $id_documento = $_GET["doc"];

    $nro_doc = str_pad($id_documento, 8, "0", STR_PAD_LEFT);

    include('conexion.php');

    $c1 = "SELECT * FROM documento WHERE id_documento = '$id_documento'";
    $ec1 = $db->query($c1);    
    $rc1 = $ec1->fetch_assoc();

    $fecha_hora = $rc1["fecha_hora"];

    $date = new DateTime($fecha_hora);
    $fecha_doc = $date->format('d-m-Y');
    $hora_doc = $date->format('H:i:s');

    $id_residente = $rc1["residente_id"];

    if ($id_residente == "0") {
        $nombre = "Cliente General";
        $cedula = "V-00.000.000";
        $direccion = "Avenida José Antonio Anzoátegui, Urb. Mene Grande, Anaco, Edo. Anzoátegui";
    }

    $id_inmueble = $rc1["inmueble_id"];

    $c2 = "SELECT * FROM inmuebles WHERE id_inmueble = '$id_inmueble'";
    $ec2 = $db->query($c2);    
    $rc2 = $ec2->fetch_assoc();

    $casa = $rc2["casa"];

    $id_cobro = $rc1["cobro_id"];
    $nro_cobro = "C".str_pad($id_cobro, 4, "0", STR_PAD_LEFT);

    $c3 = "SELECT * FROM cobros WHERE id_cobro = '$id_cobro'";
    $ec3 = $db->query($c3);    
    $rc3 = $ec3->fetch_assoc();

    $monto_cobro = $rc3["monto"];
    $monto_cobro_f = number_format($monto_cobro, 2, ',', '.');
    $descripcion = $rc3["descripcion"];
    $descripcion_cobro = strtoupper($descripcion);
    $fecha_cobro = $rc3["fecha"];
    $fecha_cobro_f = explode('-', $fecha_cobro);
    $fecha_cobro_ff = $fecha_cobro_f[2]."-".$fecha_cobro_f[1]."-".$fecha_cobro_f[0];
    $fecha_limite = $rc3["limite"];
    $fecha_limite_f = explode('-', $fecha_limite);
    $fecha_limite_ff = $fecha_limite_f[2]."-".$fecha_limite_f[1]."-".$fecha_limite_f[0];

    $id_cobro_sistema = $rc1["cobro_sistema_id"];
    $nro_cobro_sistema = "S".str_pad($id_cobro_sistema, 4, "0", STR_PAD_LEFT);

    $c4 = "SELECT * FROM cobros WHERE id_cobro = '$id_cobro_sistema'";
    $ec4 = $db->query($c4);    
    $rc4 = $ec4->fetch_assoc();

    $monto_cobro_sistema = $rc4["monto"];
    $monto_cobro_sistema_f = number_format($monto_cobro_sistema, 2, ',', '.');
    $descripcion_s = $rc4["descripcion"];
    $descripcion_cobro_s = strtoupper($descripcion_s);

    $monto_total = $monto_cobro + $monto_cobro_sistema;
    $monto_total_f = number_format($monto_total, 2, ',', '.');



?>
<style type="text/css">
<!--
    table.page_footer {width: 100%; border: none; padding: 2mm}
    h1 { padding: 0; margin: 0; color: #DD0000; font-size: 7mm; }
    h2 { padding: 0; margin: 0; color: #222222; font-size: 5mm; position: relative; }
-->
</style>
<page format="" orientation="" backcolor="#FFF" style="font: arial;">
	<page_footer>		
		<img src="img/faja.png" style="width: 100%; ">
		<div style="position: absolute; bottom: 29mm; right: 20mm; width: 30mm; font-size: 22px; text-align: center;"> Te invitamos a mantener tus pagos al día </div>
        <div style="position: absolute; bottom: 30mm; left: 22mm; width: 140mm; font-size: 14px; text-align: left; color: white; ">¡Hazlo tú mismo de forma segura, fácil y sencilla, sin llamar o salir de casa! Visita en YouTube: Condominios G de Software G y conoce a través de nuestros videos cómo puedes ingresar al sistema, hacer tus pagos, ver tu estado de cuenta, y tener control total de tu condominio</div>
        <table class="page_footer">
            <tr>
                <td style="width: 33%; text-align: left;">
                    &nbsp;
                </td>
                <td style="width: 34%; text-align: center">
                    <h6>ORIGINAL</h6>
                    <span style="font-size: 8px;">ESTE RECIBO SE EMITE CONFORME A LO DISPUESTO A LA PROVIDENCIA ADMINISTRATIVA CONDOMINIOS/2018 0091 DE LA FECHA 08/01/2018</span>
                </td>
                <td style="width: 33%; text-align: right">
                    &nbsp;
                </td>
            </tr>
        </table>
    </page_footer>
    <div style="rotate: 90; position: absolute; width: 280mm; height: 4mm; left: 211mm; top: 0; font-style: italic; font-weight: normal; text-align: center; font-size: 2.3mm;">
        ESTE RECIBO SE EMITE CONFORME A LO DISPUESTO A LA PROVIDENCIA ADMINISTRATIVA CONDOMINIOS/2018 0091 DE LA FECHA 08/01/2018
    </div>
    <table style="width: 99%;border: none;" cellspacing="4mm" cellpadding="0">
        <tr>
            <td colspan="2" style="width: 100%;">
                <div class="zone" style="height: 34mm; position: relative; font-size: 5mm;">                    
                    <img src="img/logo.png" alt="logo" style="margin-top: 0mm; margin-left: 0mm;" height=70px;>
                    <div style="position: absolute; left: 28mm; top: 2mm; text-align: left; font-size: 2.5mm; font: Coda; ">
                        <b>Asociación Civil de Propietarios del </b><br>
                        <b>Conjunto Residencial Mene Grande</b><br>
                        RIF: <b>J-29685366-5</b><br>
                        Av. José Antonio Anzoátegui, Sector<br>
                        Guayabal, Anaco, Estado Anzoátegui.<br>                        
                    </div>
                    <div style="position: absolute; left: 1mm; top: 20mm; text-align: left; border-radius:5px; font-size: 2.5mm; padding:1mm; border: 0.1mm solid black; width: 69mm;">
                        <b>Datos del cliente:</b><br>
                        Propietario: <b><?php echo $nombre ?></b><br>  
                        Cédula/RIF: <b><?php echo $cedula ?></b><br>  
                        Inmueble: <b><?php echo $casa ?></b><br> 
                        Dirección: <b><?php echo $direccion ?></b><br> 
                        
                    </div>
                    <div style="position: absolute; right:1mm;top:20mm;text-align:left;font-size:2.5mm; border-bottom: 0.2mm solid black; width: 129mm;"></div>
                    <div style="position: absolute; left: 100mm; top: 6mm; text-align: left; font-size: 4.5mm;">
                        <b>RECIBO</b>             
                    </div>
                    <div style="position: absolute; right: 25mm; top: 3mm; text-align: right; font-size: 3.0mm;">
                        <b>Número de Recibo:</b><br>
                        <b>Fecha de Emisión:</b><br>
                        <b>Hora de Emisión:</b><br>
                        <b>Página:</b><br>
                    </div>
                    <div style="position: absolute; right: 3mm; top: 3mm; text-align: right; font-size: 3.0mm;">
                        <?php echo $nro_doc ?><br>
                        <?php echo $fecha_doc ?><br>
                        <?php echo $hora_doc ?><br>
                        1/1<br>
                    </div>
                    <div style="position: absolute; left: 100mm; top: 27mm; text-align: left; font-size: 4.5mm;">
                        TOTAL A PAGAR:            
                    </div>
                    <div style="position: absolute; right: 3mm; top: 27mm; text-align: right; font-size: 4.5mm;">
                        <b>Bs. <?php echo $monto_total_f ?></b>
                    </div>
                    <div style="position: absolute; left: 1mm; top: 40mm; text-align: left; border-radius:5px; font-size: 2.5mm; border: 0.1mm solid black; width: 39mm; height: 100mm;">
                        <div style="height: 23px; background: #00B2E6; border-radius: 5px; text-align: center; font-size: 3.0mm; padding: 4px 0 2px 0; ">SERVICIO AL PROPIETARIO</div>  
                        <div style="height: 4px; background: #00B2E6; margin: -3px 0 0 0 "></div>    
                        <img src="img/banner1.jpg" style="width: 35mm; margin-left: 2mm; margin-top: 10mm;">                       
                    </div>
                    <div style="position: absolute; right:1mm;top:40mm;text-align:left;font-size:2.5mm; border-bottom: 0.2mm solid black; width: 160mm;"></div>
                    <div style="position: absolute; right:1mm;top:40mm;text-align:left;font-size:2.5mm; width: 160mm;">
                        <table style="border-bottom: 0.2mm solid black;">
                            <tr STYLE="font-size: 2.4mm;"><td style="width: 40mm; ">&nbsp;</td><td style="width: 10mm; "></td><td style="width: 15mm;"></td><td style="width: 55mm;"></td><td style="width: 15mm;"></td><td style="width: 15mm;"></td></tr>
                            <tr STYLE="COLOR: #00B2E6;">
                                <td style="width: 40mm; ">
                                    PERIODO DE FACTURACIÓN
                                </td>
                                <td style="width: 10mm; ">
                                    &nbsp;
                                </td>
                                <td style="width: 15mm;">
                                    CÓDIGO
                                </td>
                                
                                <td style="width: 55mm;">
                                    DESCRIPCIÓN
                                </td>
                                <td style="width: 15mm;">
                                    MOROSIDAD
                                </td>
                                <td style="width: 15mm; text-align:right;">
                                    PRECIO
                                </td>
                            </tr>
                            <tr STYLE="font-size: 2.4mm;"><td style="width: 40mm; ">&nbsp;</td><td style="width: 10mm; "></td><td style="width: 15mm;"></td><td style="width: 55mm;"></td><td style="width: 15mm;"></td><td style="width: 15mm;"></td></tr>
                            <tr STYLE="font-size: 2.4mm;">
                                <td style="width: 40mm; ">
                                    <b><?php echo "Cargos por servicios correspondientes al período $fecha_cobro_ff al $fecha_limite_ff" ?></b>
                                </td>
                                <td style="width: 10mm; ">
                                    
                                </td>
                                <td style="width: 15mm;">
                                    
                                </td>
                                
                                <td style="width: 55mm;">
                                    
                                </td>
                                <td style="width: 15mm;">
                                    
                                </td>
                                <td style="width: 15mm; text-align:right;">
                                   
                                </td>
                            </tr>
                            <tr STYLE="font-size: 2.4mm;"><td style="width: 40mm; ">&nbsp;</td><td style="width: 10mm; "></td><td style="width: 15mm;"></td><td style="width: 55mm;"></td><td style="width: 15mm;"></td><td style="width: 15mm;"></td></tr>
                            <tr STYLE="font-size: 2.4mm;">
                                <td style="width: 40mm; ">
                                    
                                </td>
                                <td style="width: 10mm; ">
                                    
                                </td>
                                <td style="width: 15mm;">
                                    <?php echo $nro_cobro ?>
                                </td>
                                
                                <td style="width: 55mm;">
                                    <b><?php echo $descripcion_cobro ?></b><BR>
                                    Cargo directo
                                </td>
                                <td style="width: 15mm;">
                                    0.00%
                                </td>
                                <td style="width: 15mm; text-align:right;">
                                   <?php echo $monto_cobro_f ?>
                                </td>
                            </tr>
                            <tr STYLE="font-size: 2.4mm;"><td style="width: 40mm; ">&nbsp;</td><td style="width: 10mm; "></td><td style="width: 15mm;"></td><td style="width: 55mm;"></td><td style="width: 15mm;"></td><td style="width: 15mm;"></td></tr>
                            <tr STYLE="font-size: 2.4mm;">
                                <td style="width: 40mm; ">
                                    
                                </td>
                                <td style="width: 10mm; ">
                                    
                                </td>
                                <td style="width: 15mm;">
                                    <?php echo $nro_cobro_sistema ?>
                                </td>
                                
                                <td style="width: 55mm;">
                                    <b><?php echo $descripcion_cobro_s ?></b><BR>
                                    Cargo directo
                                </td>
                                <td style="width: 15mm;">
                                    0.00%
                                </td>
                                <td style="width: 15mm; text-align:right;">
                                   <?php echo $monto_cobro_sistema_f ?>
                                </td>
                            </tr>
                            <tr STYLE="font-size: 2.4mm;"><td style="width: 40mm; ">&nbsp;</td><td style="width: 10mm; "></td><td style="width: 15mm;"></td><td style="width: 55mm;"></td><td style="width: 15mm;"></td><td style="width: 15mm;"></td></tr>
                            <tr STYLE="font-size: 2.4mm;">
                                <td style="width: 40mm; ">
                                    
                                </td>
                                <td style="width: 10mm; ">
                                    
                                </td>
                                <td style="width: 15mm;">
                                    
                                </td>
                                
                                <td style="width: 55mm;">
                                    
                                </td>
                                <td style="width: 15mm;">
                                    <b>Subtotal:</b>
                                </td>
                                <td style="width: 15mm; border-top: 0.1mm solid black; text-align:right;">
                                   <?php echo $monto_total_f ?>
                                </td>
                            </tr> 
                            <tr STYLE="font-size: 2.4mm;"><td style="width: 40mm; ">&nbsp;</td><td style="width: 10mm; "></td><td style="width: 15mm;"></td><td style="width: 55mm;"></td><td style="width: 15mm;"></td><td style="width: 15mm;"></td></tr>                           
                        </table>

                        <table style="border-bottom: 0.2mm solid black;">
                            <tr STYLE="font-size: 2.4mm;"><td style="width: 40mm; ">&nbsp;</td><td style="width: 10mm; "></td><td style="width: 15mm;"></td><td style="width: 55mm;"></td><td style="width: 15mm;"></td><td style="width: 15mm;"></td></tr>
                            <tr>
                                <td style="width: 40mm; ">
                                    <b>Pagos recibidos</b>
                                </td>
                                <td style="width: 10mm; ">
                                    
                                </td>
                                <td style="width: 15mm;">
                                    
                                </td>
                                
                                <td style="width: 55mm;">
                                    
                                </td>
                                <td style="width: 15mm;">
                                    
                                </td>
                                <td style="width: 15mm; text-align:right;">
                                
                                </td>
                            </tr>
                            <tr STYLE="font-size: 2.4mm;"><td style="width: 40mm; ">&nbsp;</td><td style="width: 10mm; "></td><td style="width: 15mm;"></td><td style="width: 55mm;"></td><td style="width: 15mm;"></td><td style="width: 15mm;"></td></tr>
                            <tr STYLE="font-size: 2.4mm;"><td style="width: 40mm; ">&nbsp;</td><td style="width: 10mm; "></td><td style="width: 15mm;"></td><td style="width: 55mm;"></td><td style="width: 15mm;"></td><td style="width: 15mm;"></td></tr>
                            
                            <?php 

                                $c5 = "SELECT * FROM documento_pago WHERE documento_id = '$id_documento' ORDER BY id_doc_pag ASC";
                                $ec5 = $db->query($c5);

                                while ($rc5 = $ec5->fetch_assoc()) {

                                    $id_pago = $rc5["id_doc_pag"];
                                    $nro_pago = "P".str_pad($id_pago, 4, "0", STR_PAD_LEFT);

                                    $fecha_pago = $rc5["fecha"];
                                    $fecha_pago_f = explode('-', $fecha_pago);
                                    $fecha_pago_ff = $fecha_pago_f[2]."-".$fecha_pago_f[1]."-".$fecha_pago_f[0];

                                    $monto_pago = $rc5["monto"];
                                    $monto_pago_f = number_format($monto_pago, 2, ',', '.');

                                    echo "
                                    <tr STYLE='font-size: 2.4mm;'>
                                        <td style='width: 40mm; '>
                                            
                                        </td>
                                        <td style='width: 10mm; '>
                                            
                                        </td>
                                        <td style='width: 15mm;'>
                                            $nro_pago
                                        </td>
                                        
                                        <td style='width: 55mm;'>
                                            <b>$fecha_pago_ff</b><BR>
                                            Pago directo
                                        </td>
                                        <td style='width: 15mm;'>
                                            
                                        </td>
                                        <td style='width: 15mm; text-align:right;'>
                                           $monto_pago_f
                                        </td>
                                    </tr>
                                    <tr STYLE='font-size: 2.4mm;'><td style='width: 40mm; '>&nbsp;</td><td style='width: 10mm; '></td><td style='width: 15mm;'></td><td style='width: 55mm;'></td><td style='width: 15mm;'></td><td style='width: 15mm;'></td></tr>
                                    ";
                                }  
                            ?>
                            
                            <tr STYLE="font-size: 2.4mm;"><td style="width: 40mm; ">&nbsp;</td><td style="width: 10mm; "></td><td style="width: 15mm;"></td><td style="width: 55mm;"></td><td style="width: 15mm;"></td><td style="width: 15mm;"></td></tr>
                            <tr STYLE="font-size: 2.4mm;">
                                <td style="width: 40mm; ">
                                    
                                </td>
                                <td style="width: 10mm; ">
                                    
                                </td>
                                <td style="width: 15mm;">
                                    
                                </td>
                                
                                <td style="width: 55mm;">
                                    
                                </td>
                                <td style="width: 15mm;">
                                    <b>Subtotal:</b>
                                </td>
                                <td style="width: 15mm; border-top: 0.1mm solid black; text-align:right;">
                                   - <?php echo $monto_total_f ?>
                                </td>
                            </tr> 
                            <tr STYLE="font-size: 2.4mm;"><td style="width: 40mm; ">&nbsp;</td><td style="width: 10mm; "></td><td style="width: 15mm;"></td><td style="width: 55mm;"></td><td style="width: 15mm;"></td><td style="width: 15mm;"></td></tr>                           
                        </table>

                        <table>                            
                            <tr STYLE="font-size: 2.4mm;"><td style="width: 40mm; ">&nbsp;</td><td style="width: 10mm; "></td><td style="width: 15mm;"></td><td style="width: 55mm;"></td><td style="width: 15mm;"></td><td style="width: 15mm;"></td></tr>
                            <tr STYLE="font-size: 2.4mm;">
                                <td style="width: 40mm; ">
                                    
                                </td>
                                <td style="width: 10mm; ">
                                    
                                </td>
                                <td style="width: 15mm;">
                                    
                                </td>
                                
                                <td style="width: 55mm;">
                                    <b>SUBTOTAL CARGOS</b><br>
                                    Cobro por morosidad de 0.00%<br>                                    
                                </td>
                                <td style="width: 15mm;">
                                    
                                </td>
                                <td style="width: 15mm; text-align:right;">
                                    <b><?php echo $monto_total_f ?></b><BR>
                                    0,00 <br>
                                </td>
                            </tr>        
                           
                            <tr STYLE="font-size: 2.4mm;">
                                <td style="width: 40mm; ">
                                    
                                </td>
                                <td style="width: 10mm; ">
                                    
                                </td>
                                <td style="width: 15mm;">
                                    
                                </td>
                                
                                <td style="width: 55mm;">
                                    <b>VALOR TOTAL DE LA OPERACIÓN</b>
                                </td>
                                <td style="width: 15mm;">
                                    
                                </td>
                                <td style="width: 15mm; border-top: 0.1mm solid black; text-align:right;">
                                   <B><?php echo $monto_total_f ?></B>
                                </td>
                            </tr>
                            <tr STYLE="font-size: 2.4mm;"><td style="width: 40mm; ">&nbsp;</td><td style="width: 10mm; "></td><td style="width: 15mm;"></td><td style="width: 55mm;"></td><td style="width: 15mm;"></td><td style="width: 15mm;"></td></tr>
                            <tr STYLE="font-size: 2.4mm;">
                                <td style="width: 40mm; ">
                                    
                                </td>
                                <td style="width: 10mm; ">
                                    
                                </td>
                                <td style="width: 15mm;">
                                    
                                </td>
                                
                                <td style="width: 55mm;">
                                    <b>TOTAL A PAGAR:</b><br>
                                    
                                </td>
                                <td style="width: 15mm;">
                                    
                                </td>
                                <td style="width: 15mm; text-align:right;">
                                    <b><?php echo $monto_total_f ?></b><BR>                                    
                                </td>
                            </tr>  
                            <tr STYLE="font-size: 2.4mm;"><td style="width: 40mm; ">&nbsp;</td><td style="width: 10mm; "></td><td style="width: 15mm;"></td><td style="width: 55mm;"></td><td style="width: 15mm;"></td><td style="width: 15mm;"></td></tr>                                                  
                        </table>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td style="width: 25%;">
                
            </td>
            <td style="width: 75%">
                
            </td>
        </tr>
    </table>
</page>
<?php
     $content = ob_get_clean();

    require_once('html2pdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'letter', 'fr', true, 'UTF-8', 0);
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('reportes/'.$nro_doc.'_'.$casa.'.pdf', 'F');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>