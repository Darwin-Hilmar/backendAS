<div class="form-group row">
    <div class="col-sm-6 mb-3 mb-sm-0">
        <label for="titulo">Título:</label>
        <input type="text" class="form-control form-control-user" id="titulo" name="curso[titulo]" value="<?php echo s($curso->titulo); ?>"
            placeholder="Ingrese un título del curso">
    </div>
    <div class="col-sm-6">
        <label for="autor">Autor:</label>
        <input type="text" class="form-control form-control-user" id="autor" name="curso[autor]" value="<?php echo s($curso->autor); ?>"
            placeholder="Ingrese el nombre del autor">
    </div>
</div>
<div class="form-group">
    <label for="palabrasClave">Palabras clave:</label> 
    <input type="text" class="form-control form-control-user" id="pclave"  name="curso[pclave]" value="<?php echo s($curso->pclave); ?>"
        placeholder="Ingrese algunas palabras clave">
</div>
<div class="form-group">
    <label for="enlace">Enlace del video(Youtube): </label> 
    <input type="text" class="form-control form-control-user" id="enlace"  name="curso[video]" value="<?php echo s($curso->video); ?>"
        placeholder="Ingrese el enlace del video">
</div>
<div class="form-group">
    <label for="descripcion">Descripción:</label> 
    <textarea type="text" class="form-control form-control-description" id="descripcion" name="curso[descripcion]"><?php echo s($curso->descripcion); ?>  
        </textarea>
</div>


