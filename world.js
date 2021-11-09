window.onload = function (){

    let lookupCntryBtn = document.getElementById("lookup");
    let lookupCityBtn = document.getElementById("city");

    lookupCntryBtn.addEventListener("click",lookupBtnClicked);
    lookupCityBtn.addEventListener("click",lookupBtnClicked);

    function lookupBtnClicked(e){
        var mode = "";
        //console.log(e.target.innerHTML == "Lookup Country")

        if(e.target.innerHTML=="Lookup Country"){
            mode = "country"
        }else{
            mode = "city"
        }
        
        
        const htr = new XMLHttpRequest();

        country = sanitizeStr(document.getElementById("country").value);

        htr.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                document.getElementById("result").innerHTML = this.responseText;
            }
        }

        htr.open("GET", "http://localhost/info2180-lab5/world.php?country="+country+"&mode="+mode);
        htr.send();
        

    }

    function sanitizeStr(str){
        str = str.replace(/[^a-z0-9áéíóúñü \.,_-]/gim,"");
        return str.trim();
    }

}