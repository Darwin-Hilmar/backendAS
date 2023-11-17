<div class="form-group row">
    <div class="col-sm-6 mb-3 mb-sm-0">
        <label for="titulo">Título:</label>
        <input type="text" class="form-control form-control-user" id="titulo" name="blog[titulo]" value="<?php echo s($blog->titulo); ?>"
            placeholder="Ingrese un título del blog">
    </div>
    <div class="col-sm-6">
        <label for="autor">Autor:</label>
        <input type="text" class="form-control form-control-user" id="autor" name="blog[autor]" value="<?php echo s($blog->autor); ?>"
            placeholder="Ingrese el nombre del autor">
    </div>
</div>
<div class="form-group">
    <label for="imagen">Imagen:</label> 
    <input type="file" class="form-control-image form-control-image" id="imagen"  name="blog[imagen]"
        accept="image/jpeg, image/png">
    <?php if($blog->imagen): ?>
        <div class="text-center mt-3" >
            <img class="mb-9 text-center rounded" src="/imagenes/<?php echo $blog->imagen; ?>" alt="imagen">
        </div> 
    <?php endif; ?>
</div>
<div class="form-group">
    <label for="descripcion">Descripción:</label> 
    <textarea type="text" class="form-control form-control-description" id="descripcion" name="blog[descripcion]"><?php echo s($blog->descripcion); ?>  
        </textarea>
</div>


