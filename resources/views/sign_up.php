<style>
    #form {
        margin-top:40px;
        margin-left: 40px;
        display: flex;
        justify-content:center;
        align-items: center;
        flex-direction: column;
        width: 400px;
        background-color: #eeeeee;
    }
    #form input {
        width: 70%;
    }
</style>

<form id="form" action="/inscription" method="post">
    Pseudo :
    <input type="text" name="pseudo">
    Password :
    <input type="text" name="password">
    Email :
    <input type="text" name="email">
    <input type="submit" value="Valider">
</form>