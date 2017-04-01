<?php
    /*PASSO 1 : PROCESSANDO OS DADOS INSERIDOS PELO USUÁRIO*/

    //Função para imprimir matriz
    function imprimirMatriz($Norigem,$Ndestino,$custo,$VetDestino,$VetOrigem)
    {

        echo"<table class=c-days border=0 align=center>";
            for($a=1; $a<=$Norigem+1; $a++)
            {  
                echo"<tr class= simple-lightgray align=center height=50px >";    
                    for($b=1; $b<=$Ndestino+1; $b++)
                    {
                        if($a == $Norigem+1)
                        {
                            echo "<td width=80px bgcolor= #b1b1b1>{$VetDestino[$b]}</td>";
                        }
                        elseif($b == $Ndestino+1)
                        {
                            echo "<td width=80px bgcolor= #b1b1b1>{$VetOrigem[$a]}</td>";
                        }
                        else
                        {
                            echo "<td  width=80px>
                                <table border=0 width=80>
                                    <tr align=right>
                                        <td width=60%><sup>&nbsp&nbsp&nbsp&nbsp&nbsp</sup></td>
                                        <td align=center style='border:1px solid #000'><sup>{$custo[$a][$b]}</sup></td>
                                    </tr>
                                    <tr>
                                        <td colspan=2 align=center>x<sub>$a$b</sub></td>
                                    </tr> 
                                </table>
                            </td>"; 
                        }
                    } 
                echo"</tr>"; 
            }
        echo"</table></p>";
    }
    
    function imprimirMatrizColorFinal($Norigem,$Ndestino,$custo,$VetDestino,$VetOrigem,$custoAux)
    {
        echo"</p><table class=c-days border=0 align=center  >";
        for($a=1; $a<=$Norigem+1; $a++)
        {  
            echo"<tr class= simple-lightgray align=center height=50px >";    
            for($b=1; $b<=$Ndestino+1; $b++)
            {
                if($a == $Norigem+1)
                {
                    echo "<td width=80px bgcolor= #b1b1b1>{$VetDestino[$b]}</td>";
                }
                elseif($b == $Ndestino+1)
                {
                    echo "<td width=80px bgcolor= #b1b1b1>{$VetOrigem[$a]}</td>";
                }
                else
                {
                    if($custoAux[$a][$b] == 'X')
                    {
                         echo "<td width=80px class=naoBasica>
                                <table border=0 width=80>
                                <tr align=right>
                                    <td width=60%><sup>&nbsp&nbsp&nbsp&nbsp&nbsp</sup></td>
                                    <td align=center style='border:1px solid #000'><sup>{$custo[$a][$b]}</sup></td>
                                </tr>
                                <tr>
                                    <td colspan=2 align=center>";
                                    echo "&nbsp</td>";
                                                                       
                               echo" </tr> 
                                </table>
                                </td>";
                    }
                    else
                    {
                        echo "<td class=atual width=80px>
                                <table border=0 width=80 >
                                <tr align=right>
                                    <td width=60%><sup>&nbsp&nbsp&nbsp&nbsp&nbsp</sup></td>
                                    <td align=center style='border:1px solid #000'><sup>{$custo[$a][$b]}</sup></td>
                                </tr>
                                 <tr>
                                    <td colspan=2 align=left>{$custoAux[$a][$b]}</td>
                                </tr>    
                                </table>
                        </td>"; 
                    }
                }
            } //<sup><sup>{$custo[$a][$b]}</sup></sup>
            echo"</tr>"; 
        }
        echo"</table></p>";
    }

    //a) Número de origens, destino e o método escolhido
    $Norigem = $_POST[linha];   
    $Ndestino = $_POST[coluna]; 
    $metodo = $_POST[metodo];
     
    //b) Declarando os vetores de origem e destino 
    $VetOrigem = array();   $VetOrigemAux = array();   
    $VetDestino = array();  $VetDestinoAux = array();   

    //c) Armazenado valores nos vetores de origem
    for($i=1; $i<= $Norigem; $i++)
    { 
        $VetOrigem[$i] = $_POST['origem'][$i];
        $VetOrigemAux[$i] = $_POST['origem'][$i];        
    }
  
    //d) Armazenado valores nos vetores de destino
    for($i=1; $i <= $Ndestino; $i++)
    { 
        $VetDestino[$i] = $_POST['destino'][$i];
        $VetDestinoAux[$i] = $_POST['destino'][$i];
    }
   
   //e) Armazenado valores na matriz de custo
    for($i=1; $i<=$Norigem; $i++)
    {
        for($j=1; $j<=$Ndestino; $j++)
        {
            $custo[$i][$j] =  $_POST['matrizCusto'][$i][$j]; 
            $custoAux[$i][$j] = 0;
        } 
    }
    
    echo"<center>A tabela abaixo apresenta os dados na forma tabular do problema de transporte.</center></p>"; 
    imprimirMatriz($Norigem,$Ndestino,$custo,$VetDestino,$VetOrigem);
    if ($metodo == "mcn") 
    {
        echo"<p><center>Método do Canto Noroeste</center> </p>";
        for ($j=1; $j <= $Ndestino ; $j++)
        {
            for ($i=1; $i <= $Norigem ; $i++)
            {
                if ($VetOrigemAux[$i] != 0 and $VetDestinoAux[$j] != 0)
                {
                    if ($VetOrigemAux[$i] <= $VetDestinoAux[$j])
                    {
                        $custoAux[$i][$j] = $VetOrigemAux[$i];
                        $VetDestinoAux[$j] -= $VetOrigemAux[$i];
                        $VetOrigemAux[$i] = 0;
                    }
                    else
                    {
                        $custoAux[$i][$j] = $VetDestinoAux[$j];
                        $VetOrigemAux[$i] -= $VetDestinoAux[$j];
                        $VetDestinoAux[$j] = 0;
                    }
                }
            }
        }
    }
    if($metodo == "mcm"){
        echo"<p><center>Método do Custo Mínimo</center> </p>";

        //a) Adicionado os custos em um vetor e ordenando os valores pelo BublleSort
        $VetorCustos = array(); $posicao = 1;
        for ($i=1; $i <= $Norigem ; $i++) 
        { 
            for ($j=1; $j <= $Ndestino; $j++) 
            { 
                $VetorCustos[$posicao] = $custo[$i][$j];
                $posicao++;
            }
        }
        $NumCustos = count($VetorCustos);//contando quantas posições existem no vetor
        $auxiliar = null;
        for ($i=1; $i <= $NumCustos ; $i++) //ordenando os valores em ordem crescente
        { 
           for ($j=1; $j <=$NumCustos ; $j++) 
           { 
                if ($VetorCustos[$i] < $VetorCustos[$j]) 
                {
                    $auxiliar = $VetorCustos[$i];
                    $VetorCustos[$i] = $VetorCustos[$j];
                    $VetorCustos[$j] = $auxiliar;
                } 
           }
        }

        $posicaoVetor = 1;  
        while ( $posicaoVetor <= $NumCustos) 
        {
            for ($i=1; $i <=$Norigem; $i++) 
            { 
                for ($j=1; $j <=$Ndestino; $j++) 
                { 
                    if ($VetorCustos[$posicaoVetor] == $custo[$i][$j]) 
                    {
                        if (($VetOrigemAux[$i] != 0) and ($VetDestinoAux[$j] != 0))
                        {
                            if ($VetOrigemAux[$i] <= $VetDestinoAux[$j]) 
                            {
                                $custoAux[$i][$j] = $VetOrigemAux[$i];
                                $VetDestinoAux[$j] -= $VetOrigemAux[$i];
                                $VetOrigemAux[$i] = 0;
                            } 
                            else 
                            {
                                $custoAux[$i][$j] = $VetDestinoAux[$j];
                                $VetOrigemAux[$i] -= $VetDestinoAux[$j];
                                $VetDestinoAux[$j] = 0;
                            } 
                        }                       
                        $j = $Ndestino+1;
                        $i = $Norigem+1;
                    } 
                }
            }
            $posicaoVetor++; 
        }
    }
    echo "</p><center>Solução inicial do problema:</center>";
    imprimirMatrizColorFinal($Norigem,$Ndestino,$custo,$VetDestino,$VetOrigem,$custoAux);

