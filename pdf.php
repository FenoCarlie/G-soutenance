<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>PROCES VERBAL</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.4/jspdf.plugin.autotable.min.js"></script>
    
<style>
    
    body {
        font-family: Arial, sans-serif;
        font-size: 12pt;
        line-height: 1.5;
    }
    
    h3 {
        font-size: 14pt;
        font-weight: bold;
    }
    
    h3, p {
        margin-top: 0;
        margin-bottom: 10px;
    }
    
    div, p {
        text-align: justify;
    }
    
    div.jury {
        margin-left: 150px;
    }
    
    div.header {
        margin-top: 100px;
        text-align: center;
    }
    
    h3.inline {
        display: inline-block;
        vertical-align: middle;
        margin-right: 5px;
    }
    
    p.inline {
        display: inline-block;
        vertical-align: middle;
    }
    
    p.underline {
        text-decoration: underline;
    }
</style>

	
</head>
<body id="target">
    <div>
    <div class="header">
        <h3>PROCES VERBAL</h3>
        <h3>SOUTENANCE DE FIN D’ETUDES POUR L’OBTENTION DU DIPLOME DE LICENCE PROFESSIONNELLE</h3>
        <div style="text-align: center;">
            <h3 class="inline">Mention :</h3>
            <p class="inline">Informatique</p>
        </div>
        <div style="text-align: center;">
            <h3 class="inline">Parcours :</h3>
            <p class="inline">Informatique général</p>
        </div>
    </div>

<div class="jury">
    <p>Mr/Mlle RAKOTO Gilbert</p>
    <p>a soutenu publiquement son mémoire de fin d’études pour l’obtention du diplôme de Licence professionnelle.</p>
    <p>Après la délibération, la commission des membres du Jury a attribué la note de 18/20 (dix-huit sur vingt).</p>
    <p class="underline">Membres du Jury</p>
    <div>
        <h3 class="inline">Président :</h3>
        <p class="inline">Mr RATIARSON Venot, Maître de Conférences</p>
    </div>
    <div>
        <h3 class="inline">Examinateur :</h3>
        <p class="inline">Mr RALAIVAO Jean Christian, Assistant d’Enseignement Supérieur et de Recherche</p>
    </div>
    <div>
        <h3 class="inline">Rapporteurs :</h3>
        <p class="inline">Mlle RATIANANTITRA Volatiana Marielle, Maître de Conférences</p>
    </div>
    <button id="cmd">Générer PDF</button>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="./pdf.js"></script>
</body>
</html>