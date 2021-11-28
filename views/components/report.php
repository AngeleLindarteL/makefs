<?php
    echo <<<EOT
    <section  id="reportSection">
        <form action="#" method="POST" id="report">
            <div class="reasonReport">
                <div id="closereport"> 
                    <img src="./img/icoCloseReport.png"  alt="closereport">
                </div>
                
                <select id="reasonSelect">
                    <option hidden selected>Escoge la razón del reporte</option>
                    <option>Información falsa</option>
                    <option>Contenido inapropiado</option>
                    <option>Otro</option>
                </select>
            </div>
            <div class="inputsReport">
                <textarea required name="detailReport" placeholder="Cuentanos a detalle el problema" id="detailReport"></textarea>
                <input type="submit" name="sendReport" value="Reportar" id="sendReport">
            </div>    
        </form>
    </section>
    EOT;
?>