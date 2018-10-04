<div class='container'>
    <form>
        <div class="form-group">
            <label>Email address</label>
            <input id="email" class="form-control" type="email" name="email" required/>
        </div>
        <input class="btn btn-primary" type="button" value="Send Me the Password" onclick="sendFormData()" />
    </form> 
</div>
<script>
    function sendFormData(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert(xmlhttp.responseText);
            }
        };
        xmlhttp.open("POST", "send_password.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        console.log(document.getElementById("email").value);
        xmlhttp.send("email="+document.getElementById("email").value);
    }
</script>