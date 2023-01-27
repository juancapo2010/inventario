<h2>Formulario de contacto</h2>
<form action={{route('contact')}} method="POST">
     {{ csrf_field() }}
     <div class="form-group">
        <label for="name">email</label>
        <input name="email" type="text">
    </div>
    <div class="form-group">
        <label for="name">email2</label>
        <input name="email2" type="text">
    </div>
    <div class="form-group">
        <label for="name">Nombre</label>
        <input name="name" type="text">
    </div>
    <div class="form-group">
        <label for="name">Mensaje</label>
                                <input name="msg" type="text">
    </div>
    <div class="form-group">
        <button type="submit" id='btn-contact' class="btn">Enviar</button>
    </div>
</form>