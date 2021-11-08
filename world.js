window.onload = function (){

    let lookupBtn = document.getElementById("lookup");

    lookupBtn.addEventListener("click",lookupBtnClicked);

    function lookupBtnClicked(e){

        const htr = new XMLHttpRequest();

        country = sanitizeStr(document.getElementById("country").value);

        htr.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                document.getElementById("result").innerHTML = this.responseText;
            }
        }

        htr.open("GET", "http://localhost/info2180-lab5/world.php?country="+country);
        htr.send();

    }

    function sanitizeStr(str){
        str = str.replace(/[^a-z0-9áéíóúñü \.,_-]/gim,"");
        return str.trim();
    }

}