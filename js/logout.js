$(document).ready(function(){
    $("#logout").on('click',function(){
        let logout = true;
        let $confirm = confirm("Tem Certeza que Deseja Deslogar?")
        if($confirm)
        {
            $.ajax({
                method: 'get',
                url: 'http://localhost/geradorXml/App/Controller/Login/Logout.php',
                cache: false,
                async:false,
                data:{logout:logout}
            }).done(function(){
                window.location.replace("http://localhost/geradorXml");      
            });
        }
    });
});