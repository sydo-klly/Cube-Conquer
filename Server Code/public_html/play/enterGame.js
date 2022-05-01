function submitForm() {
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "./enterGame.php", true); 
    xhttp.onreadystatechange = function() {

        if (this.readyState === 4) {
            if (this.status === 200) {
                document.getElementById("uop_error").textContent = '';

                var response = this.responseText;
                console.log(response);
                window.location.href = "http://cubeconquer.com/play/player.html";        
            }else if (this.status === 400){
                var response = this.responseText;
                console.log(response);


                if(response=="too much players"){

                    document.getElementById("uop_error").textContent = 'There are too many players in this game';
                    document.getElementById("gameCode").value = '';
                    document.getElementById("name").value = '';

                }else if(response=="already a player with this name"){
                    document.getElementById("uop_error").textContent = 'Already a player with this name';
                    document.getElementById("name").value = '';


                }else if(response=="partida no en sistema"){
                    document.getElementById("uop_error").textContent = 'Wrong game code';
                    document.getElementById("gameCode").value = '';
                    document.getElementById("name").value = '';

                }else{

                    document.getElementById("uop_error").textContent = 'something went wrong: please try again';
                    document.getElementById("gameCode").value = '';
                    document.getElementById("name").value = '';

                }
                
            }
        }      

    };
    form = document.getElementById('formName');
    let data = new FormData(form);
    xhttp.send(data);
    return false;
}