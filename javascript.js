var Blinker = window.setInterval("Blinken()",1000);

function Blinken()
{
        if (document.getElementById("kreisr1")) {
          if(document.getElementById("kreisr1").style.display == "none")
          {
                  document.getElementById("kreisr1").style.display = "block";
                  document.getElementById("kreisr2").style.display = "none";
          }
          else
          {
                  document.getElementById("kreisr2").style.display = "block";
                  document.getElementById("kreisr1").style.display = "none";
          }
        }
        if (document.getElementById("kreisb1")) {
          if(document.getElementById("kreisb1").style.display == "none")
          {
                  document.getElementById("kreisb1").style.display = "block";
                  document.getElementById("kreisb2").style.display = "none";
          }
          else
          {
                  document.getElementById("kreisb2").style.display = "block";
                  document.getElementById("kreisb1").style.display = "none";
          }
        }
}

