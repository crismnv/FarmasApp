<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top" bgcolor="#f6f3e4" style="background-color:#f6f3e4;"><br>
    <br>
    <table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" valign="top" style="padding-left:13px; padding-right:13px; background-color:#ffffff;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="84" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="80" align="center" valign="middle" bgcolor="#d80000" style="font-family:Arial, Helvetica, sans-serif; color:#ffffff;"><div style="font-size:20px;"><b>------------</b></div><div style="font-size:15px;"><b><?=  date("Y-m-d");;?> </b></div><div style="font-size:20px;"><b>------------</b></div></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center" valign="middle" style="font-family:Georgia, 'Times New Roman', Times, serif; font-size:48px;"><i>FarmasApp</i></td>
          </tr>
            {{-- <td align="center" valign="middle" style="padding-bottom:15px; padding-top:15px;"><img src="img/divider.gif" width="573" height="28"></td> --}}
            <hr>
          <tr>
            <td align="center" valign="middle" style="font-family:Georgia, 'Times New Roman', Times, serif; color:#000000; font-size:24px; padding-bottom:5px;"><i>

              @if($reserva->estado_reserva === 'LISTO')
              USTED YA PUEDE RECOGER SU PREPARADO
              @elseif($reserva->estado_reserva === 'CANCELADO')
              SU RESERVA HA SIDO CANCELADA, PARA MAYOR INFORMACIÓN ACERQUESE A NUESTRA FARMACIA
              @elseif($reserva->estado_reserva === 'APROBADO')
              SU RESERVA HA SIDO APROBADA, LE AVISAREMOS CUANDO SE EMPEZARÁ A PREPARAR
              @elseif($reserva->estado_reserva === 'PREPARANDO')
              SE RESERVA ESTA SIENDO PREPARADA, LE AVISAREMOS CUANCO ESTE LISTO
              @endif
              </i>
            </td>
          </tr>
            
            {{-- <td align="center" valign="middle" style="padding-bottom:15px; padding-top:15px;"><img src="img/divider.gif" width="573" height="28"></td> --}}
            <hr>
          </tr>
          <tr>
            <td align="center" valign="middle" style="padding-top:7px;"><table width="240" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <!-- <td height="31" align="center" valign="middle" bgcolor="#d80000" style="font-family:Georgia, 'Times New Roman', Times, serif; font-size:19px; color:#ffffff;">Month/Year</td> -->
              </tr>
            </table></td>
          </tr>
          <tr>
            {{-- <td align="center" valign="middle" style="padding-top:15px;"><img src="{{ asset('/reservas/' . $reserva->imagen) }}" class="img-fluid img-rounded rounded mx-auto d-block" alt="Sample photo" name="imagen-vista" id="imagen-vista" width="500" height="500"><br></td> --}}
          </tr>
          <tr>
            {{-- <td align="center" valign="middle" style="padding-bottom:15px; padding-top:15px;"><img src="img/divider.gif" width="573" height="28"></td> --}}
            <hr>
          </tr>
          
          <tr></tr>
          
          <tr>
            <td align="left" valign="middle" style="font-family:Georgia, 'Times New Roman', Times, serif; font-size:12px; color:#000000;">
            <div style="color:#b30467; font-size:15px;"><b>CONTACTANOS</b></div>
             <div><br>
               Cualquier duda, consulta o reclamo acerquese o llamenos.<br>
               <br>
             </div>
              
               <div><br>
                DIRECCION<br>
Jirón José Olaya 567,   <br>
Chimbote,<br>
 Del Santa,  
Ancash - Perú<br>
+51 934131688 <br>
<br>
<br>
              </div></td>
          </tr>
        </table></td>
      </tr>
    </table>
    <br>
    <br></td>
  </tr>
  <tr>
    <td align="center" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
