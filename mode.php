let container = document.getElementsByClassName("lightMode");
let element1 = document.querySelector("#bulb");
let element2 = document.querySelector("#ModeText");
let logoutBtn = document.getElementById("logoutBtn");
function ChangeMode(){
    if(element2.innerText == "Dark"){
      document.querySelector("#htmlTag").setAttribute("data-theme", "light");
      element2.innerText = "Light";
      element1.classList.add("fa-solid");
      element1.classList.remove("fa-regular");
      element1.style.color = "#2d3138";
      element2.style.color = "#2d3138";
      logoutBtn.style.backgroundColor = "#6935B3";
      <?php // $_SESSION["mode"] = "light";?>
      <!-- let mode = "<?php // echo $_SESSION['mode']?>"; -->
      <!-- console.log(mode); -->
    }else if(element2.innerText == "Light"){
      document.querySelector("#htmlTag").setAttribute("data-theme", "dark");
      element2.innerText = "Dark";
      element1.classList.add("fa-regular");
      element1.classList.remove("fa-solid");
      element1.style.color = "#a4acba";
      element2.style.color = "#a4acba";
      logoutBtn.style.backgroundColor = "#9062CA";
      <?php $_SESSION["mode"] = "dark";?>
      let mode = "<?php echo $_SESSION['mode']?>";
      console.log(mode);
    }
}