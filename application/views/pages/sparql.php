<div id="content">
    <form action="<?php echo base_url('validate') ?>" method="post" accept-charset="UTF-8" id="sparql-form">
        <input type="hidden" name="languageSyntax" value="SPARQL">
        <input type="hidden" name="outputFormat" value="sparql">
        <textarea name="query" id="sparql">
        PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
        PREFIX owl: <http://www.w3.org/2002/07/owl#>
        PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
        PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
        PREFIX sedic: <http://www.semanticweb.org/sedic#>

        SELECT DISTINCT ?plants WHERE { ?plants rdf:type sedic:Plante . }
        </textarea>
        <div class="buttons">
            <input type="submit" name="send" value="Send Query" id="send-sparql" >
        </div>
    </form>
    <code><div class="result"></div></code>
</div>