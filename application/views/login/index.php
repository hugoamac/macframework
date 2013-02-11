<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>MyFramewrok | Área de Acesso</title>
        <link href="<?= $this->baseUrl() ?>css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
            <form method="post" action="/login/logar" id="form_login">
                <fieldset>
                    <legend>Dados de Acesso</legend>
                    <label>Login:</label><br/>
                    <input type="text" name="login"/><br/>
                    <label>Password:</label><br/>
                    <input type="password"   name="pass"/><br/><br/>
                    <button type="submit">Logar</button>
                </fieldset>
            </form>
    </body>
</html>

