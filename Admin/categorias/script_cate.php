<script type="application/javascript">
    window.onload = init();

    function con_hijos (id, slct){
        var clasif;
        // Create our XMLHttpRequest object
        var httpr = new XMLHttpRequest();
        // Create some variables we need to send to our PHP file
        var url = "load_clasificador.php";
        var vars = "id="+id+"&slct="+slct+"&act=<?php echo $clstmp->id; ?>";
        httpr.open("POST", url, false);
        // Set content type header information for sending url encoded variables in the request
        httpr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // Access the onreadystatechange event for the XMLHttpRequest object
        httpr.onreadystatechange = function() {
            if(httpr.readyState == 4 && httpr.status == 200) {
                var divRow = document.getElementById('selectcat');
                var sss = httpr.responseText;
                //alert (tblcat.innerHTML);
                divRow.insertAdjacentHTML('beforeEnd',sss);
                //tblcat.insertBefore(sss,tblcat.lastChild)
                //alert ("Vizz ->>>>> "+sss);
            }
        }

        // Send the data to PHP now... and wait for response to update the status div
        httpr.send(vars); // Actually execute the request
        //document.getElementById("status").innerHTML = "processing...";
    }

    function init()
    {
        <?php
        //$asctmp = $clstmp->listar_Ascendencia();
        //$asctmp = array_reverse($asctmp,false);

        $asctmp = explode('/',$asctmp.$clstmp->id);
        $asctmp = array_filter($asctmp,'strlen');

        //print_r($asctmp);

        $sz = count($asctmp);
        $asc = array();
        //$asc[] = array(0, current($asctmp));
        for ($i=0; $i<$sz-1; ++$i) {
            $asc[] = array(current($asctmp), next($asctmp));
        }
        //$asc[] = array(current($asctmp),$clstmp->id);

        echo "var asc = ".json_encode($asc).";\n";
        //echo "var act = ".$clstmp->id.";\n";
        ?>
        for (var i=0 in asc) {
            //alert(asc[i][0]+" , "+asc[i][1]);
            con_hijos (asc[i][0],asc[i][1]);
        }

        listaasc();
    }

    function listaasc ()
    {
        var lstslc = document.getElementsByName('categ[]');
        var sz = lstslc.length;
        //alert("elems: "+slctd.length);

        var strtmp = "Raiz > ";
        for (var i=0; i<sz; ++i) {
            //alert ("++ Indice : "+slctd.item(i).selectedIndex);
            if (lstslc.item(i).selectedIndex) {
                strtmp += lstslc.item(i).options[lstslc.item(i).selectedIndex].text;
                strtmp += " > ";
            }
        }
        var nom = document.getElementById('txtnombre').value;
        strtmp += "<b>[ "+nom+" ]</b>";

        var lstctg = document.getElementById('lstcategorias');
        lstctg.innerHTML = strtmp;
    }

    function carga_hijos (slct)
    {
        var divRow = document.getElementById('selectcat');
        var filacont = slct.parentNode.parentNode;
        alert(slct.parentNode +"  -> "+filacont +" : "+ filacont.rowIndex);
        console.log(slct.parentNode);
        console.log(filacont);
        console.log(divRow);
        var filas = divRow.rows.length;
        alert ("Filas: "+filas);
        while (filas-1 > filacont.rowIndex) {
            alert("Antes: "+filacont.rowIndex+"/"+filas);
            divRow.deleteRow(filas-1);
            filas = divRow.rows.length;
            alert("Despues: "+filacont.rowIndex+"/"+filas);
        }

        alert ("selected: "+slct.selectedIndex+" : "+slct.value+" : "+slct.options[slct.selectedIndex].text );


        if (slct.selectedIndex) {
            alert("Ahora: "+filacont.rowIndex+"/"+filas);
            con_hijos (slct.value,0);
        }
        listaasc();
    }
</script>