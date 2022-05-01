var o=100;
var d=100;
var q=0;



let dict = {
  1:'A',
  2:'B',
  3:'C',
  4:'D',
  5:'E',
  6:'F',
  7:'G',
  8:'H',
  9:'I',
  10:'J',
  100:'',
}

let mapa = {
  1:[2,6,7],
  2:[1,3,5,6],
  3:[2,4,5],
  4:[3,5,10],
  5:[2,3,4,6,9,10],
  6:[1,2,5,7,8,9],
  7:[1,6,8],
  8:[6,7,9],
  9:[5,6,8,10],
  10:[4,5,9]
}


function canvi(base) {
  document.getElementById("sent").innerText="";
  if(o==100){
    o = base;
    makedisable(o);

  }else if(d==100){
    d = base;
    makedisable(100);
  }else{
    o = base;
    d = 100;
    makedisable(o);
  }
  document.getElementById("origen").innerText=dict[o];
  document.getElementById("desti").innerText=dict[d];

  checkifdisabled();

  
}


function makedisable(baseO){
  var restantes = [1,2,3,4,5,6,7,8,9,10];

  if (baseO!=100 && q < 100 && q!=-1 ){
    
    for(var i = 1 ; i<=10; ++i){
      document.getElementById(dict[i]).disabled=true;
    }
    
    for (var i = 0 ; i<mapa[baseO].length ; ++i){
      document.getElementById(dict[mapa[baseO][i]]).disabled=false;
    }

    

  }else{

    for(var i = 1 ; i<=10; ++i){
      document.getElementById(dict[i]).disabled=false;
    }
  }
}

function set(n) {
  document.getElementById("sent").innerText="";
  if (n != -1){
    q = n;
    document.getElementById("quantitat").innerText=q;

  }
  else {
    q = -1;
    document.getElementById("quantitat").innerText='FULL';
  }
  
  checkifdisabled();
}
function canvia(n) {
  document.getElementById("sent").innerText="";
  if (q==-1){
    q = 0;  
  }else{
    q += n;
  }

  document.getElementById("quantitat").innerText=q;

  checkifdisabled();
} 



function updateOnInput(val) {
  document.getElementById(suma5)
}


function checkifdisabled(){

  if(o!=100 && d!=100 && q!=0){
    document.getElementById("submitButton").disabled=false;
  }

}

function execute() {

    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "./newMovement.php", true); 
    xhttp.onreadystatechange = function() {
       if (this.readyState == 4 && this.status == 200) {
          var o=100;
          var d=100;
          var q=0;
         document.getElementById("sent").innerText="Units Ready For Deployment";
         document.getElementById("origen").innerText=dict[o];
         document.getElementById("desti").innerText=dict[d];
         document.getElementById("quantitat").innerText='';

       }else{
          var o=100;
          var d=100;
          var q=0;
         document.getElementById("sent").innerText="something went wrong: restarting server";
       }
    };
    
    var form = document.createElement("form");
    var BaseOrigen = document.createElement("input"); 
    var BaseDesti = document.createElement("input");  
    var Quantitat = document.createElement("input");

    // document.getElementById('form').style = 'visibility:hidden';  

    form.method = "POST";
    form.action = "newMovement.php";   

    BaseOrigen.value=o;
    BaseOrigen.name="BaseOrigen";
    form.appendChild(BaseOrigen);  

    BaseDesti.value=d;
    BaseDesti.name="BaseDesti";
    form.appendChild(BaseDesti);  

    Quantitat.value= q;
    Quantitat.name="Quantitat";
    form.appendChild(Quantitat); 

    // document.body.appendChild(form);

    let data = new FormData(form);
    xhttp.send(data);
    return false;
}