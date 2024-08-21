<!DOCTYPE html>

<html>
  <head>
    <title></title>

    <style>
     

      .modal {
        width: 100%;
        height: 100vh;
        background: rgba(0, 0, 0, 0.8);

        position: absolute;
        top: 0;
        left: 0;

        animation: modal 2s forwards;
        visibility: hidden;
        opacity: 0;
      }

      #cerrar {
        display: none;
      }

      #cerrar + label {
        position: fixed;
        color: #fff;
        font-size: 25px;
        z-index: 50;
        background: darkred;
        height: 40px;
        width: 40px;
        line-height: 40px;
        border-radius: 50px;
        right: 10px;
        cursor: pointer;

        animation: modal 2s forwards;
        visibility: hidden;
        opacity: 0;
      }

      #cerrar:checked + label,
      #cerrar:checked ~ .modal {
        display: none;
      }

      @keyframes modal {
        100% {
          visibility: visible;
          opacity: 1;
        }
      }
    </style>
  </head>

  <body>
    <input type="checkbox" id="cerrar" />
    <label for="cerrar" id="btn-cerrar">x</label>
    <div class="modal">
        <img src="assets/img/imgAlert.jpg" />  
    </div>
  </body>
</html>