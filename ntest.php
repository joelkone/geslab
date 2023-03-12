<!DOCTYPE html>
<html>
  <head>
    <style>
      .menu-item {
        background-color: white;
        padding: 10px;
        cursor: pointer;
      }
      
      .selected {
        background-color: lightblue;
      }
    </style>
  </head>
  <body>
    <div id="menu">
      <div class="menu-item" id="item1">Élément 1</div>
      <div class="menu-item" id="item2">Élément 2</div>
      <div class="menu-item" id="item3">Élément 3</div>
    </div>
    <script>
      const menu = document.querySelector("#menu");
      menu.addEventListener("click", function(event) {
        const items = menu.querySelectorAll(".menu-item");
        for (let item of items) {
          item.classList.remove("selected");
        }
        event.target.classList.add("selected");
      });
    </script>
  </body>
</html>
