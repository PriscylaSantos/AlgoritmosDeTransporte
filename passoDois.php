
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    $origem= $_POST['origem'];
    $destino = $_POST['destino'];
?>
 
    <form target='_blank' name="form1" method ="post" action="index.php?arquivo=resultado.php" onSubmit='return validaRadio(this);'>
<?php
//enctype='multipart/form-data'
    echo "<center>Abaixo, insira os valores das Origens, dos Destinos e dos custos. Os valores dos custos podem variar de 0 a 999999</center></p>";
    echo"<table class=c-days border=0 align=center>";
        for($a=0; $a<=$origem+1; $a++)
        {  
            echo"<tr class= simple-lightgray align=center height=50px >";    
                for($b=0; $b<=$destino+1; $b++)
                {
                    if($a == 0)
                    {
                        if($b == $destino+1)
                        {
                          echo "<td width=80px bgcolor= #fff>Origem</td>";
                        }
                        elseif($b == 0)
                        {
                            echo "<td width=80px bgcolor= #fff></td>";
                        }
                        else
                        {
                            echo "<td width=80px bgcolor= #fff>$b</td>";

                        }
                    }
                    elseif ($b == 0) 
                    {
                        if($a == $origem+1)
                        {
                            echo "<td width=80px bgcolor= #fff>Destino</td>";
                        }
                        else
                        {
                            echo "<td width=80px bgcolor= #fff>$a</td>";
                        }
                    }
                    elseif ($a == $origem+1 and $b == $destino+1 ) 
                    {
                        echo "<td width=80px bgcolor= #b1b1b1></td>";
                    }
                    elseif($a == $origem+1)
                    {
                        echo "<td  width=80px bgcolor= #b1b1b1>
                              <table border=0 width=80>
                                <tr align=right>
                                    <td width=60%><sup>&nbsp&nbsp&nbsp&nbsp&nbsp</sup></td>
                                    <td align=center ></td>
                                </tr>
                                <tr>
                                    <td colspan=2 align=center> <input name = 'destino[$b]' required=''  title='Insira somente números' type=text size=3 maxlength= 6 id=search-text placeholder='D$b'></td>
                                </tr> 
                            </table>
                        </td>"; 
                        //echo "<td width=80px bgcolor= #b1b1b1>{$VetDestino[$b]}</td>";
                    }
                    elseif($b == $destino+1)
                    {
                        echo "<td  width=80px bgcolor= #b1b1b1>
                              <table border=0 width=80>
                                <tr align=right>
                                    <td width=60%><sup>&nbsp&nbsp&nbsp&nbsp&nbsp</sup></td>
                                    <td align=center ></td>
                                </tr>
                                <tr>
                                    <td colspan=2 align=center><input name = 'origem[$a]' required='' title='Insira somente números' type=text size=3 maxlength=6 id=search-text placeholder='s$a'></td>
                                </tr> 
                            </table>
                        </td>"; 
                        //echo "<td width=80px bgcolor= #b1b1b1>{$VetOrigem[$a]}</td>";
                    }
                    else
                    {
                        echo "<td  width=80px>
                              <table border=0 width=80>
                                <tr align=center>
                                    <td width=60%><sup>&nbsp&nbsp&nbsp&nbsp&nbsp</sup></td>
                                    <td align=right></td>
                                </tr>
                                <tr>
                                    <td colspan=2 align=center><input name = 'matrizCusto[$a][$b]' required='' title='Insira somente números' type=text size=3  maxlength= 6 id=search-text placeholder='C$a$b' ></td>
                                </tr> 
                            </table>
                        </td>"; 
                    }
                } 
            echo"</tr>"; 
        }
    echo"</table></p>";
     echo'<p> <center>Por qual método deseja resolver:</p>
            <input type="radio" name="metodo" value="mcn">Método do Canto Noroeste</br>
            <input type="radio" name="metodo" value="mcm">Método do Custo Mínimo</br>            

   </center>';
   echo" </p>
        <input type='hidden' name= 'linha' value= '$origem'></input> 
        <input type='hidden' name= 'coluna' value= '$destino'></input>
        <center> <input type='submit' class='noisy dblue' value='Enviar'/></center>
        </form>";
